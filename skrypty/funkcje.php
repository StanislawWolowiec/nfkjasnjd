<?php

function cUrl($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $response = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $odpowiedz = array("dane" => $response, "status" => $status);
    return $odpowiedz;
}

function DB($DBH, $zapytanie, $parametry)
{
    if ($parametry == false) {
        $STH = $DBH->prepare($zapytanie);
        $STH->execute();
    } else {
        $STH = $DBH->prepare($zapytanie);
        $STH->execute($parametry);
    }
    return $STH;
}

function DBProdukt($DBH, $jsonString, $url)
{
    $jsonData = json_decode($jsonString, true);
    $nazwa = $jsonData["basicInfo"]["name"];
    $kategoria = $jsonData["basicInfo"]["objectType"];
    $parametry = array($jsonString, $url, $nazwa, $kategoria);
    DB($DBH, "INSERT INTO `wczytane`(`json`, `url`, `nazwa`, `kategoria`) VALUES (?,?,?,?);", $parametry);
}

?>