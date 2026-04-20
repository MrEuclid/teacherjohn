<?php
// Secure the page - ensure they have registered a team
session_save_path(__DIR__ . '/sessions');
session_start();

if (!isset($_SESSION['team_name'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tournament: Logic Lab</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom styles for clear visual hierarchy */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f4f8; /* Light background */
        }
        .container {
            max-width: 900px;
        }
        
        /* THE CONTAINER (The Cell) */
        /* Handles size, border (hover), and positioning */
        .grid-cell {
            transition: all 0.2s ease-in-out;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            border: 4px solid transparent; 
            border-radius: 12px;
            background-color: white; /* Card background */
            width: 100px;
            height: 100px;
        }
        .grid-cell:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.25);
            border: 4px solid #10b981; /* Highlight border on the CELL */
        }
        
        /* THE SHAPE (Inner Visual) */
        /* Styles applied to the inner div */
        .shape-square { 
            border-radius: 12px; 
        }
        .shape-circle { 
            border-radius: 50%; 
        }
        .shape-diamond {
            border-radius: 4px;
            transform: rotate(45deg);
        }
        .shape-triangle { 
            /* CSS for an equilateral triangle pointing down */
            width: 0 !important;
            height: 0 !important;
            border-left: 45px solid transparent; /* Adjusted for container size */
            border-right: 45px solid transparent;
            border-bottom-width: 90px;
            border-bottom-style: solid;
            background-color: transparent !important; 
            transform: translateY(-5px); /* Center visually */
        }
    </style>
</head>
<body class="p-4 md:p-8 min-h-screen flex flex-col items-center justify-start">
    
    <div class="w-full max-w-[900px] mb-4">
        <a href="dashboard.php" class="bg-white text-slate-600 px-4 py-2 rounded-lg font-bold shadow-sm border border-slate-200 inline-block">
            ← Back to Dashboard
        </a>
    </div>

    <div id="app" class="container bg-white p-6 md:p-10 rounded-xl shadow-2xl space-y-8 border-b-8 border-indigo-200">
        <header class="text-center space-y-2">
            <h1 class="text-5xl font-black text-indigo-600 mb-2 tracking-tight">Puzzle 2: Logic Lab</h1>
            <p class="text-slate-500 font-bold text-lg">Match the 4 Objects to the 6 Clues!</p>
        </header>

        <div class="flex flex-col md:flex-row gap-8">
            
            <div class="md:w-1/3 bg-indigo-50 p-6 rounded-lg border-2 border-indigo-200 shadow-inner">
                <h2 class="text-2xl font-bold text-indigo-700 mb-4">Current Clues:</h2>
                <ol id="clues-list" class="list-decimal list-inside space-y-3 text-lg text-gray-700 font-medium">
                    </ol>
                <div class="mt-6 p-3 bg-indigo-100 rounded-md text-sm text-indigo-800 font-semibold">
                    <p>💡 Click the shapes to change their Shape. Hold Alt/Option or Ctrl and click to change their Color.</p>
                </div>
            </div>

            <div class="md:w-2/3 space-y-6 flex flex-col justify-center">
                
                <div id="game-grid" class="flex justify-around items-end h-40 bg-gray-100 p-4 rounded-lg shadow-lg border border-gray-200">
                    </div>
                
                <div id="position-labels" class="flex justify-around px-4">
                    <div class="text-center w-[100px] text-lg font-bold text-gray-500">Pos 1</div>
                    <div class="text-center w-[100px] text-lg font-bold text-gray-500">Pos 2</div>
                    <div class="text-center w-[100px] text-lg font-bold text-gray-500">Pos 3</div>
                    <div class="text-center w-[100px] text-lg font-bold text-gray-500">Pos 4</div>
                </div>

                <div class="flex justify-center gap-4 pt-4">
                    <button id="check-btn" class="px-8 py-4 bg-green-500 text-white text-xl font-black rounded-xl shadow-lg shadow-green-200 hover:bg-green-600 transition-all uppercase tracking-wider transform hover:scale-105">
                        Submit Answer
                    </button>
                </div>

                <p id="feedback-message" class="text-center text-xl font-bold min-h-[30px]"></p>
            </div>
        </div>
    </div>

    <div id="winModal" class="fixed inset-0 bg-indigo-900/80 backdrop-blur-sm hidden flex items-center justify-center p-4 z-[100]">
        <div class="bg-white rounded-[3rem] p-10 max-w-sm w-full text-center shadow-2xl border-[12px] border-green-400">
            <div class="text-6xl mb-4">🏆</div>
            <h2 class="text-4xl font-black text-slate-800 mb-2">BRILLIANT!</h2>
            <p class="text-slate-500 mb-8 font-bold leading-tight">You solved the logic grid. Puzzle 3 is now unlocked!</p>
            
            <form action="dashboard.php" method="POST">
                <input type="hidden" name="puzzle_solved" value="2">
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-black py-5 rounded-2xl transition-all shadow-xl shadow-green-200 uppercase tracking-widest">
                    Continue to Map
                </button>
            </form>
        </div>
    </div>
    
    <script>
        // --- 1. CONFIGURATION AND STATE ---
        const POSITIONS = [1, 2, 3, 4]; // 4 Positions

        const COLORS_MAP = {
            'red': '#f87171',   // Red
            'blue': '#60a5fa',  // Blue
            'green': '#4ade80', // Green
            'yellow': '#facc15' // Yellow
        };
        const COLOR_NAMES = Object.keys(COLORS_MAP);
        const SHAPES = ['square', 'circle', 'triangle', 'diamond']; 
        const SHAPE_CSS = {
            'square': 'shape-square',
            'circle': 'shape-circle',
            'triangle': 'shape-triangle',
            'diamond': 'shape-diamond' 
        };

        let currentSolution = []; 
        let userArrangement = []; 
        
        // Helper functions
        const getColorNameByIndex = (index) => COLOR_NAMES[index];
        const getShapeNameByIndex = (index) => SHAPES[index];

        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }
        
        // --- 2. CORE GAME LOGIC ---
        function generateSolution() {
            const shuffledColors = COLOR_NAMES.slice();
            const shuffledShapes = SHAPES.slice();
            shuffleArray(shuffledColors);
            shuffleArray(shuffledShapes);
            
            return POSITIONS.map((pos, index) => ({
                position: pos,
                color: shuffledColors[index],
                shape: shuffledShapes[index]
            }));
        }

        function generateClues() {
            const solution = currentSolution;
            const generatedClues = [];
            
            // 1. Direct Link Pool
            const directClues = solution.map(item => `The **${item.color}** object is at **Position ${item.position}**.`);
            
            // 2. Binary Positional Pool
            const binaryClues = [];
            for (let i = 0; i < 3; i++) {
                const shapeA = solution[i].shape;
                const shapeB = solution[i+1].shape;
                const colorA = solution[i].color;
                const colorB = solution[i+1].color;

                binaryClues.push(`The **${shapeA}** is on the **immediate left** of the **${shapeB}**.`);
                binaryClues.push(`The **${colorB}** is on the **immediate right** of the **${colorA}**.`);
            }

            // 3. Associative Pool
            const associativeClues = solution.map(item => `The **${item.color}** object is the **${item.shape}**.`);
            
            // --- Selection Strategy (6 Clues) ---
            const direct1 = directClues.splice(Math.floor(Math.random() * directClues.length), 1)[0];
            generatedClues.push(direct1);
            const direct2 = directClues.splice(Math.floor(Math.random() * directClues.length), 1)[0];
            generatedClues.push(direct2);

            const binary1 = binaryClues.splice(Math.floor(Math.random() * binaryClues.length), 1)[0];
            generatedClues.push(binary1);
            const binary2 = binaryClues.splice(Math.floor(Math.random() * binaryClues.length), 1)[0];
            generatedClues.push(binary2);
            
            const assoc1 = associativeClues.splice(Math.floor(Math.random() * associativeClues.length), 1)[0];
            generatedClues.push(assoc1);
            const assoc2 = associativeClues.splice(Math.floor(Math.random() * associativeClues.length), 1)[0];
            generatedClues.push(assoc2);
            
            shuffleArray(generatedClues);
            return generatedClues;
        }

        // --- 3. UI RENDERING AND INTERACTION ---
        function applyCellStyles(shapeElement, newColorName, newShapeName) {
            const newColorHex = COLORS_MAP[newColorName];

            // Reset classes
            shapeElement.classList.remove(...SHAPES.map(s => `shape-${s}`));
            shapeElement.classList.add(SHAPE_CSS[newShapeName]);
            
            // Reset styles
            shapeElement.style.width = '';
            shapeElement.style.height = '';
            shapeElement.style.backgroundColor = '';
            shapeElement.style.borderBottomColor = '';
            shapeElement.style.transform = ''; 

            if (newShapeName === 'triangle') {
                shapeElement.style.width = '0px';
                shapeElement.style.height = '0px';
                shapeElement.style.backgroundColor = 'transparent';
                shapeElement.style.borderBottomColor = newColorHex; 
            } else if (newShapeName === 'diamond') {
                shapeElement.style.width = '65px'; 
                shapeElement.style.height = '65px';
                shapeElement.style.backgroundColor = newColorHex;
                shapeElement.style.transform = 'rotate(45deg)'; 
            } else {
                shapeElement.style.width = '80px'; 
                shapeElement.style.height = '80px';
                shapeElement.style.backgroundColor = newColorHex;
            }
        }

        function renderGrid() {
            const gridContainer = document.getElementById('game-grid');
            gridContainer.innerHTML = '';
            userArrangement = [];

            const initialColors = COLOR_NAMES.slice();
            const initialShapes = SHAPES.slice();
            shuffleArray(initialColors);
            shuffleArray(initialShapes);

            POSITIONS.forEach((pos, index) => {
                const startColorName = initialColors[index];
                const startShapeName = initialShapes[index];

                const cellContainer = document.createElement('div');
                cellContainer.className = `grid-cell`;
                
                cellContainer.dataset.position = pos;
                cellContainer.dataset.colorIndex = COLOR_NAMES.indexOf(startColorName);
                cellContainer.dataset.shapeIndex = SHAPES.indexOf(startShapeName);

                const shapeElement = document.createElement('div');
                shapeElement.className = 'shape-visual';

                applyCellStyles(shapeElement, startColorName, startShapeName);

                cellContainer.appendChild(shapeElement);
                cellContainer.addEventListener('click', handleCellClick);
                gridContainer.appendChild(cellContainer);
                
                userArrangement.push({
                    position: pos,
                    color: startColorName,
                    shape: startShapeName,
                    element: cellContainer
                });
            });
        }
        
        function handleCellClick(e) {
            const cellContainer = e.currentTarget; 
            const shapeElement = cellContainer.querySelector('.shape-visual');
            const position = parseInt(cellContainer.dataset.position);
            
            let colorIndex = parseInt(cellContainer.dataset.colorIndex);
            let shapeIndex = parseInt(cellContainer.dataset.shapeIndex);

            let newShapeName;
            let newColorName;

            if (e.altKey || e.ctrlKey) {
                 colorIndex = (colorIndex + 1) % COLOR_NAMES.length;
                 newColorName = getColorNameByIndex(colorIndex);
                 newShapeName = getShapeNameByIndex(shapeIndex); 
            } else {
                 shapeIndex = (shapeIndex + 1) % SHAPES.length;
                 newShapeName = getShapeNameByIndex(shapeIndex);
                 newColorName = getColorNameByIndex(colorIndex); 
            }
            
            cellContainer.dataset.colorIndex = colorIndex;
            cellContainer.dataset.shapeIndex = shapeIndex;

            applyCellStyles(shapeElement, newColorName, newShapeName);

            const state = userArrangement.find(a => a.position === position);
            if (state) {
                state.color = newColorName;
                state.shape = newShapeName;
            }

            document.getElementById('feedback-message').textContent = '';
        }

        function checkSolution() {
            let correctCount = 0;

            userArrangement.forEach((userItem) => {
                const solutionItem = currentSolution.find(sol => sol.position === userItem.position);
                
                if (solutionItem && 
                    solutionItem.color === userItem.color && 
                    solutionItem.shape === userItem.shape) {
                    correctCount++;
                }
            });

            const feedback = document.getElementById('feedback-message');
            if (correctCount === 4) { 
                // Show Victory Modal instead of text
                document.getElementById('winModal').classList.remove('hidden');
            } else {
                feedback.textContent = `Keep trying! You have ${correctCount} correct out of 4.`;
                feedback.className = "text-center text-xl font-bold text-red-500 mt-2";
            }
        }

        function startNewPuzzle() {
            currentSolution = generateSolution();
            const clues = generateClues();

            const cluesList = document.getElementById('clues-list');
            cluesList.innerHTML = '';
            const colorRegex = new RegExp(COLOR_NAMES.join('|'), 'g');
            clues.forEach(clue => {
                const li = document.createElement('li');
                
                const coloredClue = clue.replace(colorRegex, (match) => 
                    `<span style="color: ${COLORS_MAP[match]}; font-weight: 800;">${match}</span>`
                );
                li.innerHTML = coloredClue;
                cluesList.appendChild(li);
            });

            renderGrid();
            document.getElementById('feedback-message').textContent = '';
        }

        // --- 4. INITIALIZATION ---
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('check-btn').addEventListener('click', checkSolution);
            startNewPuzzle();
        });
    </script>
</body>
</html>