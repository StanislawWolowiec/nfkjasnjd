<?php

include("funkcje.php");

// łączenie z bazą
$DBH = new PDO("mysql:host=localhost;dbname=komputa", "root", "");
$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// odbieranie typu operacji
$typ = $_POST["Typ"];

//      główny kod

// jeżeli użytkownik usuwa wszystkie dane
if ($typ == "wszystko") {
    DB($DBH, "TRUNCATE wczytane;", false);
}
// jeżeli użytkownik usuwa pojedyńczy produkt
else if ($typ == "pojedynczy") {
    $id = $_POST["id"];
    print ($id);
    DB($DBH, "DELETE FROM wczytane WHERE id = ?", array($id));
}

$back = $_POST["back"];
header("location: " . $back);

?>