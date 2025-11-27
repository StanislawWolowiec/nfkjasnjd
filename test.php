<?php
print ("start");
print ("<br>");
$DBH = new PDO("mysql:host=localhost;dbname=komputa", "root", "");
$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// funkcje
function wylozujZapisaneUrl($DBH)
{
    $url = "";
    // zdobądź zapisane url
    $STH = $DBH->prepare("SELECT `url` FROM `zapisane`");
    $STH->execute();
    $savedUrls = $STH->fetchAll(PDO::FETCH_COLUMN);
    // wylosuj losowy url z zapisanych
    $randomKey = array_rand($savedUrls, 1);
    $url = $savedUrls[$randomKey];
    return $url;
}

$result = wylozujZapisaneUrl($DBH);
print ($result);
?>