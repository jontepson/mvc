<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);


$header = $header ?? null;
$message = $message ?? null;


?><h1><?= $header ?></h1>

<p><?= $message ?></p>
<form method="POST">
    <label> Tärningar </label>
    <input type="number" name="dices" min="1" max="2" />
    <input type="submit" name="submit" value="Spela" />
</form>

<form method="POST">
    <label> Slå </label>
    <input type="submit" name="roll" value="Rulla" />
<form>
<form method="POST">
    <label> Slå </label>
    <input type="submit" name="rollcomp" value="Rulla Dator" />
<form>

    <p>UserHand</p>


<?php   if (isset($userHand)) {?>
    <p><?= $userHand ?></p>
<?php   } ?>
<?php  if (isset($_SESSION['grapharray'])) {
    foreach ($_SESSION['grapharray'] as $item) { ?>
    <img src="<?= $item ?>" style="height: 50px; width: 50px;" >
<?php   }
} ?>
    <p>Computer Hand</p>
    <?php   if (isset($computerHand)) {?>
    <p><?= $computerHand ?></p>
<?php   } ?>
<?php   if (isset($_SESSION['compgrapharray'])) {
        foreach ($_SESSION['compgrapharray'] as $item) {  ?>
        <img src="<?= $item ?>" style="height: 50px; width: 50px;" >
<?php   }
} ?>

<?php   if (isset($_SESSION['compWins'])) {?>
        <p> Datorvinster </p>
        <p><?= $_SESSION['compWins'] ?></p>
<?php  } ?>

<?php   if (isset($_SESSION['userWins'])) {?>
        <p> Användarvinster </p>
        <p><?= $_SESSION['userWins'] ?></p>
<?php  } ?>