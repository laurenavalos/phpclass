<?php
$playerRoll1 = mt_rand(1,6);
$playerRoll2 = mt_rand(1,6);
$playerTotal = $playerRoll1 + $playerRoll2;

$computerRoll1 = mt_rand(1,6);
$computerRoll2 = mt_rand(1,6);
$computerRoll3 = mt_rand(1,6);
$computerTotal = $computerRoll1 + $computerRoll2 + $computerRoll3;

if ($playerTotal > $computerTotal) {
    $result = "You win!";
}else if ($playerTotal < $computerTotal) {
    $result = "Computer wins!";
}
else {
    $result = "Tie!";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Magic 8-Ball</title>
    <link rel="stylesheet" href="/css/base.css">
</head>
<body>
<?php
include "../includes/header.php"
?>
<div id = "three-column">
    <?php
    include "../includes/nav.php"
    ?>
    <main>
        <h2>Roll the Dice</h2>
        <p>Your score: <?= $playerTotal?> </p>
        <div class="dice-row">
            <img src="images/dice_<?= $playerRoll1?>.png" alt="dice1">
            <img src="images/dice_<?= $playerRoll2?>.png" alt="dice2">
        </div>

        <p>Computer's score: <?= $computerTotal?> </p>
        <div class="dice-row">
            <img src="images/dice_<?= $computerRoll1?>.png" alt="comp1">
            <img src="images/dice_<?= $computerRoll2?>.png" alt="comp2">
            <img src="images/dice_<?= $computerRoll3?>.png" alt="comp3">
        </div>

        <h3>Result: <?= $result ?></h3>
    </main>
</div>
<?php
include "../includes/footer.php"
?>
</body>
</html>
