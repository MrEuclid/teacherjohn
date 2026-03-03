<?php
// makeQuestion9.php
$digits = isset($_GET['digits']) ? intval($_GET['digits']) : 1;
$operation = isset($_GET['operation']) ? $_GET['operation'] : '+';
$difficulty = isset($_GET['difficulty']) ? intval($_GET['difficulty']) : 1;
$level = isset($_GET['level']) ? intval($_GET['level']) : 1;

function generateProblem($op, $diff, $lvl) {
    // Difficulty scaling logic based on Grade Level ($lvl) and Button selection ($diff)
    // Level 0 = Grade 2, Level 3 = Grade 6
    $baseRange = pow(10, $lvl); 
    $diffMultiplier = pow(10, $diff - 1);
    
    $min = 1 * $diffMultiplier;
    $max = 10 * $baseRange * $diffMultiplier;

    $a = rand($min, $max);
    $b = rand($min, $max);

    switch ($op) {
        case '+':
            $ans = $a + $b;
            $q = "$$ $a + $b = $$";
            break;
        case '-':
            if($a < $b) { $t=$a; $a=$b; $b=$t; }
            $ans = $a - $b;
            $q = "$$ $a - $b = $$";
            break;
        case '*':
            // Grades 2-3 do smaller tables, Grade 6 does large 3-digit
            $a = rand(2, 5 * $lvl + 5);
            $b = rand(2, 10 + (2 * $diff));
            $ans = $a * $b;
            $q = "$$ $a \\times $b = $$";
            break;
        case '/':
            $ans = rand(2, 10 + $lvl);
            $b = rand(2, 12);
            $a = $ans * $b;
            $q = "$$ $a \\div $b = $$";
            break;
    }
    return ['q' => $q, 'a' => $ans];
}
?>

<div class="row g-3">
    <?php for ($i = 1; $i <= 4; $i++): 
        $data = generateProblem($operation, $difficulty, $level);
    ?>
    <div class="col-md-3">
        <div class="question-card shadow-sm" id="card<?= $i ?>">
            <div class="q-label"><?= chr(64 + $i) ?></div>
            <div class="math-display">
                <?= $data['q'] ?>
            </div>
            <input type="hidden" id="sol<?= $i ?>" value="<?= $data['a'] ?>">
            <input type="number" class="form-control ans-input" id="ans<?= $i ?>" placeholder="..." autocomplete="off">
        </div>
    </div>
    <?php endfor; ?>
</div>