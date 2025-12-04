<?php

include("funkcje.php");

// łączenie z bazą
$DBH = new PDO("mysql:host=localhost;dbname=komputa", "root", "");
$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// odbieranie typu operacji
$typ = $_POST["Typ"];

function wylosujNowyUrl($DBH)
{
    $noweUrl = ""; // nowe url

    // wydobądź zapisane produkty
    $odpowiedz = DB($DBH, "SELECT `url` FROM `zapisane`", false);
    $zapisaneUrl = $odpowiedz->fetchAll(PDO::FETCH_COLUMN); // wszystkie zapisane url do tabeli $zapisaneURL
    // wydobądź wczytane url
    $odpowiedz = DB($DBH, "SELECT `url` FROM `wczytane`", false);
    $wczytaneUrl = $odpowiedz->fetchAll(PDO::FETCH_COLUMN);
    // sprawdź czy jest jakieś zapisane url, które nie jest wczytane
    $nieWczytaneAleZapisaneUrl = array_diff($zapisaneUrl, $wczytaneUrl);
    $nieWczytaneAleZapisaneUrl = array_values($nieWczytaneAleZapisaneUrl); // napraw indexy
    if (!empty($nieWczytaneAleZapisaneUrl)) {
        // jeśli istnieją to wybierz losowy
        $losowyIndex = array_rand($nieWczytaneAleZapisaneUrl, 1);
        $noweUrl = $nieWczytaneAleZapisaneUrl[$losowyIndex];
    } else {
        // jeśli nie istnieją to wylosuj nowy
        $gotowe = false;
        while ($gotowe == false) {
            $randomIndex = random_int(890942, 909964);
            $testowanyUrl = "https://www.komputronik.pl/api/front/v1/pages/product/" . $randomIndex;

            $cUrlResponse = cUrl($testowanyUrl);

            if ($cUrlResponse['status'] == 200) {
                // dobry kod - przyjmujemy
                $noweUrl = $testowanyUrl;
                $gotowe = true;
            }
        }
        // dodaj nowe url do zapisanych
        DB($DBH, "INSERT INTO `zapisane`(`id`, `url`) VALUES (Null,'" . $noweUrl . "')", false);
    }
    return $noweUrl;
}
function wprowadzProduktDoBazy($DBH, $url)
{
    // wydobądź dane z przeglądarki
    $cUrlResponse = cUrl($url);
    // wydobądź wczytane url
    $odpowiedz = DB($DBH, "SELECT `url` FROM `wczytane`", false);
    $wczytaneUrl = $odpowiedz->fetchAll(PDO::FETCH_COLUMN);

    //      sprawdzanie błędów

    if ($cUrlResponse["status"] != 200) {
        // jeżeli zły status to zwróć false
        return false;
    }
    if (in_array($url, $wczytaneUrl)) {
        // jeżeli url jest już wczytany to zwróć false
        return false;
    }

    //      jeśli nie ma błędów

    DBProdukt($DBH, $cUrlResponse['dane'], $url);
    return true;

}


//      główny kod

// jeżeli użytkownik dodaje losowe dane
if ($typ == "losowe") {
    $ilosc = $_POST["LiczbaLosowych"];
    for ($i = 0; $i < $ilosc; $i++) {
        $noweUrl = wylosujNowyUrl($DBH);
        wprowadzProduktDoBazy($DBH, $noweUrl);
    }
}
// jeżeli użytkownik dodaje konkretne url
else if ($typ == "url") {
    $url = $_POST["url"];
    wprowadzProduktDoBazy($DBH, $url);
}

header("location: ../dane.php");

?>