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
    <label> Slå </label>
    <input type="submit" name="roll" value="Rulla" />
</form>
<?php  if (isset($_SESSION['round'])) { ?>
    <p>Du ska samla på <?= $_SESSION['round'] + 1?></p>
<?php } else { ?>
<p>Du ska samla på 1 </p>
<?php } ?>
    <p>UserHand</p>

<?php  if (isset($userHand)) { ?>
    <p><?= $userHand ?></p>
<?php } ?>
<form method="POST">
<?php  if (isset($_SESSION['yatzygrapharray'])) {
    $counter = 0;
    foreach ($_SESSION['yatzygrapharray'] as $item) {  ?>
    <img src="../view/img/<?= $item ?>.png" style="height: 50px; width: 50px;" >
    <input type="checkbox" name="dices[]" value="<?= $counter ?>">
<?php   $counter += 1;
    }
} ?>
<input type="submit" name="yatzy" value="Yatzy" />
</form>
<h2> Save and play next round </h2>
<form method="POST">
<input type="submit" name="next" value="Next" />
</form>


<?php   if (isset($_SESSION['sum'])) { ?>
    <p>Din score är: <?= $_SESSION['sum'] ?></p>
<?php } ?>

<?php   if (isset($_SESSION['bonus'])) { ?>
    <p><?= $_SESSION['bonus'] ?></p>
<?php } ?>
