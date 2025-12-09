<?php
include("funkcje.php");
$DBH = new PDO("mysql:host=localhost;dbname=komputa", "root", "");
$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST["dodaj"])) {
    DB($DBH, "INSERT INTO koszyk(`id`,`product_id`) VALUES(?,?)", array(null, $_POST["dodaj"]));
}

if (isset($_POST["usun"])) {
    DB($DBH, "DELETE FROM koszyk WHERE id = ?", array($_POST["usun"]));
}
$back = $_POST["back"];

// Add koszyk=1 only if it's not already present
if (strpos($back, 'koszyk=1') === false) {
    $separator = (strpos($back, '?') !== false) ? '&' : '?';
    $back .= $separator . "koszyk=1";
}
header("location: " . $back);
exit();
?>