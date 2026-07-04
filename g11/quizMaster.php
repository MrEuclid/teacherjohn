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
        echo "<option>Error: $dbServer is not defined</option>";
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

        // State Variables
        let currentQNumber = 1;
        let allQuestions = [];
        // Map the numeric answers from your database to letters
        const answerMap = { "1": "A", "2": "B", "3": "C", "4": "D", "5": "E" };

        // --- 2. LOAD DATA FROM MYSQL (VIA PHP) ---
        function loadTopic() {
            const gameID = document.getElementById('topic-select').value;
            if (!gameID) return;

            // Fetch from your new PHP script using the gameID
            fetch(`get_quiz.php?gameID=${gameID}`)
                .then(res => res.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }

                    // Find the array holding the questions
                    const table = data.find(item => item.type === "table" && item.name === "askAudienceQuestions");
                    allQuestions = table ? table.data : [];
                    
                    if(allQuestions.length === 0) {
                        alert("No questions found for this topic!");
                        return;
                    }

                    // Reset the round to Question 1
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
        // Sync Dashboard with actual database state
        db.ref('currentRound').on('value', (snapshot) => {
            const data = snapshot.val();
            if (data) {
                currentQNumber = data.questionNumber;
                document.getElementById('status-display').innerText = 
                    `Current Question: ${currentQNumber} | Status: ${data.status.toUpperCase()}`;
            }
        });

        // Listen for live student answers coming in
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

            // Push the actual text to Firebase so students don't need the JSON file!
            db.ref('currentRound').set({ 
                status: "released",
                questionNumber: currentQNumber,
                questionText: currentQuestionData.question,
                optA: currentQuestionData.optionA,
                optB: currentQuestionData.optionB,
                optC: currentQuestionData.optionC,
                optD: currentQuestionData.optionD,
                optE: currentQuestionData.optionE
            });
            
            // Clear out old responses for the new round
            db.ref('responses').remove(); 
            document.getElementById('response-list').innerHTML = "";
        }

        function terminateRound() {
            if (allQuestions.length === 0) return;

            const q = allQuestions[currentQNumber - 1];
            // Look up the correct letter (e.g., if database says answer is "2", it becomes "B")
            const correctLetter = answerMap[q.answer] || q.answer; // Fallback in case you start using actual letters in the DB

            // 1. Get all responses for this round
            db.ref('responses').once('value').then(snapshot => {
                const responses = snapshot.val();
                
                if (!responses) {
                    // Nobody answered
                    db.ref('currentRound').update({ status: "waiting" });
                    return;
                }

                // 2. Get the current overall scores
                db.ref('scores').once('value').then(scoreSnap => {
                    let currentScores = scoreSnap.val() || {};

                    // 3. Loop through responses and award points
                    Object.values(responses).forEach(res => {
                        if (currentScores[res.student] === undefined) {
                            currentScores[res.student] = 0; 
                        }
                        
                        // Award 100 points for a correct answer!
                        if (res.answer === correctLetter) {
                            currentScores[res.student] += 10;
                        }
                    });

                    // 4. Save updated scores to database, then terminate round
                    db.ref('scores').set(currentScores).then(() => {
                        db.ref('currentRound').update({ status: "waiting" });
                    });
                });
            });
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
            // Escape commas in names/answers to keep CSV formatting intact
            const name = `"${res.student}"`;
            const answer = `"${res.answer}"`;
            const time = res.time.toFixed(2);
            // Note: Since 'question' text isn't in 'responses', 
            // we use the currentQuestionNumber for reference
            csvContent += `${name},Question ${currentQNumber},${answer},${time}\n`;
        });

        // Trigger browser download
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