<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizmaster Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 2rem auto; }
        .control-panel { background: #e3f2fd; padding: 20px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #90caf9; }
        .btn { padding: 15px 25px; font-size: 16px; font-weight: bold; cursor: pointer; margin: 5px; border-radius: 5px; border: none; }
        .btn-release { background: #4caf50; color: white; }
        .btn-terminate { background: #f44336; color: white; }
        .btn-next { background: #2196f3; color: white; }
        .btn-reset { background: #555; color: white; font-size: 12px; padding: 10px; margin-top: 20px; }
        #status-display { font-size: 1.2em; font-weight: bold; color: #333; margin-bottom: 15px; margin-top: 15px; }
        select { padding: 10px; font-size: 16px; border-radius: 5px; }
        .responses-board { background: #fff; padding: 15px; border: 1px solid #ddd; border-radius: 5px; }
        ul { list-style-type: none; padding-left: 0; }
        li { padding: 8px; border-bottom: 1px solid #eee; }
        /* Toast Notification Styles */
        #toast-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .toast {
            background: #ff9800;
            color: white;
            padding: 15px 20px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
            font-weight: bold;
            font-size: 16px;
            animation: slideIn 0.3s ease-out;
            transition: opacity 0.5s ease;
        }
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>

    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-database.js"></script>
</head>
<body>

    <h1>Quizmaster Control Panel</h1>
    
    <div class="control-panel">
     
        <label for="topic-select"><strong>Choose Topic (Game ID): </strong></label>
        <select id="topic-select" onchange="loadTopic()">
            <option value="">-- Select a Topic --</option>
            <?php
            require_once '../connectTeacherJohn.php';
            
            // Debug: Check if the connection variable is recognized
            if (!isset($dbServer)) {
                echo "<option>Error: \$dbServer is not defined</option>";
            }

            $query = "SELECT id, title FROM gameTitles ORDER BY id DESC";
            $result = mysqli_query($dbServer, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = htmlspecialchars($row['id']);
                    $title = htmlspecialchars($row['title']);
                    echo "<option value='$id'>$title (Game $id)</option>";
                }
            } else {
                echo "<option>No games found in database</option>";
            }
            ?>
        </select>

        <div id="status-display">Please select a topic to start.</div>
        
        <button class="btn btn-release" onclick="releaseQuestion()">Release Question</button>
        <button class="btn btn-terminate" onclick="terminateRound()">Terminate Round (Score)</button>
        <hr>
        <button class="btn btn-next" onclick="nextQuestion()">Move to Next Question</button>
        <br>
        <button class="btn btn-reset" onclick="resetGame()">Danger: Reset Entire Game & Scores</button>
        <button class="btn btn-export" onclick="exportResponses()" style="background: #9c27b0; color: white;">Export Responses (CSV)</button>
    </div>
    
    <div id="toast-container"></div>
    
    <div class="responses-board">
        <h3>Live Responses:</h3>
        <ul id="response-list"></ul>
    </div>

    <script>
        // --- 1. PASTE YOUR FIREBASE CONFIG HERE ---
        const firebaseConfig = {
            apiKey: "AIzaSyD8c_2XHR5TOD2MnOUFqp5lA73YZd-qcd0",
            authDomain: "maths-comp.firebaseapp.com",
            databaseURL: "https://maths-comp-default-rtdb.asia-southeast1.firebasedatabase.app",
            projectId: "maths-comp",
            storageBucket: "maths-comp.firebasestorage.app",
            messagingSenderId: "1039547262286",
            appId: "1:1039547262286:web:b395094c0847455213ea1f"
        };
        firebase.initializeApp(firebaseConfig);
        const db = firebase.database();

        // --- Live Anti-Cheat Monitor ---
        const dashboardLoadTime = Date.now(); 

        db.ref('warnings').on('child_added', (snapshot) => {
            const warning = snapshot.val();
            if (warning.timestamp && warning.timestamp > dashboardLoadTime) {
                showWarningToast(`⚠️ ${warning.student} navigated away from the quiz!`);
            }
        });

        function showWarningToast(message) {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = 'toast';
            toast.innerText = message;
            
            container.appendChild(toast);
            
            setTimeout(() => {
                toast.style.opacity = '0'; 
                setTimeout(() => toast.remove(), 500); 
            }, 6000);
        }

        // State Variables
        let currentQNumber = 1;
        let allQuestions = [];
        const answerMap = { "1": "A", "2": "B", "3": "C", "4": "D", "5": "E" };

        // --- 2. LOAD DATA FROM MYSQL (VIA PHP) ---
        function loadTopic() {
            const gameID = document.getElementById('topic-select').value;
            if (!gameID) return;

            fetch(`get_quiz.php?gameID=${gameID}`)
                .then(res => res.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }

                    const table = data.find(item => item.type === "table" && item.name === "askAudienceQuestions");
                    allQuestions = table ? table.data : [];
                    
                    if(allQuestions.length === 0) {
                        alert("No questions found for this topic!");
                        return;
                    }

                    currentQNumber = 1;
                    db.ref('currentRound').set({ questionNumber: 1, status: "waiting" });
                    
                    alert(`Loaded ${allQuestions.length} questions for Game ${gameID}!`);
                })
                .catch(err => {
                    console.error("Failed to load topic:", err);
                    alert("Failed to load questions. Check your PHP script connection.");
                });
        }

        // --- 3. LISTEN TO FIREBASE ---
        db.ref('currentRound').on('value', (snapshot) => {
            const data = snapshot.val();
            if (data) {
                currentQNumber = data.questionNumber;
                document.getElementById('status-display').innerText = 
                    `Current Question: ${currentQNumber} | Status: ${data.status.toUpperCase()}`;
            }
        });

        db.ref('responses').on('child_added', (snapshot) => {
            const answer = snapshot.val();
            const list = document.getElementById('response-list');
            const li = document.createElement('li');
            li.innerText = `${answer.student} answered ${answer.answer} in ${answer.time}s.`;
            list.appendChild(li);
        });

        // --- 4. QUIZMASTER ACTIONS ---
        function releaseQuestion() {
            if (allQuestions.length === 0) {
                alert("Please select a topic from the dropdown first!");
                return;
            }

            const currentQuestionData = allQuestions[currentQNumber - 1];

            db.ref('currentRound').set({ 
                status: "released",
                questionNumber: currentQNumber,
                questionText: currentQuestionData.question,
                optA: currentQuestionData.optionA,
                optB: currentQuestionData.optionB,
                optC: currentQuestionData.optionC,
                optD: currentQuestionData.optionD,
                optE: currentQuestionData.optionE,
                correctAnswer: currentQuestionData.answer 
            });
            
            db.ref('responses').remove(); 
            document.getElementById('response-list').innerHTML = "";
        }

        function terminateRound() {
            if (allQuestions.length === 0) return;

            const q = allQuestions[currentQNumber - 1];
            const correctLetter = answerMap[q.answer] || q.answer; 

            // 1. Get all responses for this round
            db.ref('responses').once('value').then(snapshot => {
                const responses = snapshot.val();
                
                // 2. Fetch the current scores from Firebase before updating them
                db.ref('scores').once('value').then(scoreSnapshot => {
                    let currentScores = scoreSnapshot.val() || {};

                    if (responses) {
                        Object.values(responses).forEach(res => {
                            let studentKey = res.student;

                            if (!studentKey || typeof studentKey !== 'string' || studentKey.trim() === "") {
                                console.warn("Ignored a blank submission");
                                return; 
                            }

                            studentKey = studentKey.replace(/[.#$/\[\]]/g, "_");

                            if (currentScores[studentKey] === undefined) {
                                currentScores[studentKey] = 0; 
                            }
                            
                            if (res.answer === correctLetter) {
                                currentScores[studentKey] += 10; 
                            }
                        });
                    }

                    // 4. Save updated scores to database, then terminate round
                    db.ref('scores').set(currentScores).then(() => {
                        db.ref('currentRound').update({ status: "waiting" });
                    }).catch(err => {
                        console.error("Failed to save scores:", err);
                        alert("Error saving scores. Check the console.");
                    });
                }); // Closes the scores fetch
            }); // Closes the responses fetch
        }

        function nextQuestion() {
            if (currentQNumber >= allQuestions.length) {
                alert("You have reached the end of this topic!");
                return;
            }
            
            currentQNumber++;
            db.ref('currentRound').set({ questionNumber: currentQNumber, status: "waiting" });
            db.ref('responses').remove();
            document.getElementById('response-list').innerHTML = "";
        }
        
        function resetGame() {
            if(confirm("Are you sure? This will delete all student scores and start over at Question 1!")) {
                db.ref('scores').remove();
                db.ref('responses').remove();
                db.ref('currentRound').set({ questionNumber: 1, status: "waiting" });
                document.getElementById('response-list').innerHTML = "";
            }
        }

        function exportResponses() {
            db.ref('responses').once('value').then(snapshot => {
                const responses = snapshot.val();
                if (!responses) {
                    alert("No responses found to export!");
                    return;
                }

                let csvContent = "data:text/csv;charset=utf-8,Name,Question,Response,Time(s)\n";
                
                Object.values(responses).forEach(res => {
                    const name = `"${res.student}"`;
                    const answer = `"${res.answer}"`;
                    const time = res.time.toFixed(2);
                    csvContent += `${name},Question ${currentQNumber},${answer},${time}\n`;
                });

                const encodedUri = encodeURI(csvContent);
                const link = document.createElement("a");
                link.setAttribute("href", encodedUri);
                link.setAttribute("download", "quiz_responses.csv");
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            });
        }
    </script>
</body>
</html>