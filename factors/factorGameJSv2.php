<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Factor Game</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        body {
            background-color: #f4f7f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .game-header {
            background: linear-gradient(135deg, #0d6efd, #0dcaf0);
            color: white;
            padding: 20px 0;
            border-radius: 0 0 15px 15px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .stat-box {
            background: white;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            border-bottom: 4px solid #0d6efd;
            font-size: 1.2rem;
            font-weight: bold;
        }
        .stat-box.choices { border-bottom-color: #ffc107; background-color: #fffdf5; }
        .stat-box.score { border-bottom-color: #198754; color: #198754; font-size: 1.5rem; }
        .stat-box.status { border-bottom-color: #0dcaf0; }

        button.num {
            border: none;
            width: 60px;
            height: 60px;
            text-align: center;
            margin: 6px;
            border-radius: 50%; 
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
            transition: transform 0.15s ease-in-out, box-shadow 0.15s;
            box-shadow: 0 2px 4px rgba(0,0,0,0.15);
        }
        button.num:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
            cursor: pointer;
        }
        
        .rules-card { border-left: 5px solid #0dcaf0; }
        .backend-data { display: none; }
    </style>
</head>
<body>

<div class="container pb-5">
    
    <div class="row game-header align-items-center">
        <div class="col-md-3 text-center text-md-start px-4 mb-3 mb-md-0">
            <a href="indexSecondaryMaths.php" class="btn btn-light btn-sm me-2" title="Back">
                <i class="bi bi-arrow-left"></i> Back
            </a>
            <button id="retryBtn" class="btn btn-warning btn-sm fw-bold shadow-sm" style="display: none;">
                <i class="bi bi-arrow-counterclockwise"></i> Retry Level
            </button>
        </div>
        <div class="col-md-6 text-center">
            <h2 class="mb-0 fw-bold">The Factor Game <span class="badge bg-warning text-dark fs-6 ms-2 align-middle">v2.3</span></h2>
        </div>
        <div class="col-md-3 text-center text-md-end px-4 mt-3 mt-md-0">
            <select id="level" class="form-select shadow-sm w-auto d-inline-block fw-bold text-primary border-0">
                <option value="" disabled selected>Select Level...</option>
                <option value="6">Easy (6)</option>
                <option value="12">Medium (12)</option>
                <option value="18">Hard (18)</option>
                <option value="24">Difficult (24)</option>
                <option value="30">Very Difficult (30)</option>
                <option value="36">Extreme (36)</option>
            </select>
        </div>
    </div>

    <div id="howMany" class="backend-data"></div>

    <div class="row mb-4 g-3 justify-content-center">
        <div class="col-md-3">
            <div class="stat-box status">
                <div class="text-muted small text-uppercase">Status</div>
                <span id="gameStatus">Waiting</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box score">
                <div class="text-muted small text-uppercase">Score</div>
                <span id="total">0</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="stat-box choices">
                <div class="text-muted small text-uppercase">Your Choices</div>
                <span id="myChoices"> * </span>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-12 text-center">
            <div class="p-4 bg-white rounded-3 shadow-sm border" style="min-height: 250px;">
                <div id="numberBalls" class="d-flex flex-wrap justify-content-center align-items-center h-100 mt-4 text-muted">
                    <h5>Please select a level to generate the board.</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card rules-card shadow-sm border-0">
                <div class="card-body p-4">
                    <h4 class="card-title fw-bold"><i class="bi bi-info-circle text-info me-2"></i> Game Rules</h4>
                    <ul class="list-group list-group-flush mt-3">
                        <li class="list-group-item border-0"><i class="bi bi-check2-circle text-success me-2"></i> You can only choose numbers which still have factors.</li>
                        <li class="list-group-item border-0"><i class="bi bi-check2-circle text-success me-2"></i> The numbers you can choose will be highlighted in green.</li>
                        <li class="list-group-item border-0"><i class="bi bi-check2-circle text-success me-2"></i> When you choose a number, it is added to your score.</li>
                        <li class="list-group-item border-0"><i class="bi bi-check2-circle text-success me-2"></i> When you choose a number, its factors are removed from the board.</li>
                        <li class="list-group-item border-0 fw-bold text-primary mt-2"><i class="bi bi-trophy-fill text-warning me-2"></i> If you get the maximum possible score, you win!</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div> 

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const levelSelect = document.getElementById('level');
    const numberBalls = document.getElementById('numberBalls');
    const gameStatus = document.getElementById('gameStatus');
    const totalScore = document.getElementById('total');
    const myChoices = document.getElementById('myChoices');
    const howMany = document.getElementById('howMany');
    const retryBtn = document.getElementById('retryBtn');

    // Reusable function to fetch and load a level
    function loadLevel(level) {
        numberBalls.innerHTML = '<div class="spinner-border text-primary my-5" role="status"><span class="visually-hidden">Loading...</span></div>';
        gameStatus.innerText = 'Playing';
        gameStatus.className = "";
        totalScore.innerText = '0';
        myChoices.innerText = ' * ';
        
        // Show the Retry Button now that a game has started
        retryBtn.style.display = 'inline-block';

        fetch(`factorv2Scripts.php?level=${level}`)
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.text();
            })
            .then(data => {
                howMany.innerHTML = data;
                Array.from(howMany.querySelectorAll("script")).forEach(oldScript => {
                    const newScript = document.createElement("script");
                    Array.from(oldScript.attributes).forEach(attr => newScript.setAttribute(attr.name, attr.value));
                    newScript.appendChild(document.createTextNode(oldScript.innerHTML));
                    oldScript.parentNode.replaceChild(newScript, oldScript);
                });
                
                if (numberBalls.innerHTML.includes('spinner-border')) {
                    numberBalls.innerHTML = ''; 
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                alert('Request failed. Please check your connection.');
                numberBalls.innerHTML = '<h5 class="text-danger">Failed to load game board.</h5>';
            });
    }

    // Trigger when Dropdown changes
    levelSelect.addEventListener('change', function() {
        loadLevel(this.value);
    });

    // Trigger when Retry is clicked
    retryBtn.addEventListener('click', function() {
        if (levelSelect.value) {
            loadLevel(levelSelect.value);
        }
    });
});
</script>
</body>
</html>