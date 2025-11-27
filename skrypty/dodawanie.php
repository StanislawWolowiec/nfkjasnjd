<?php
// łączenie z bazą
$DBH = new PDO("mysql:host=localhost;dbname=komputa", "root", "");
$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// informacje do powrotu do poprzedniej strony
$customStatus = null;
$returnUrl = null;

// funkcje
function wylosujNoweUrl($DBH)
{
    // url
    $url = "";
    $urlBase = "https://www.komputronik.pl/api/front/v1/pages/product/";
    $urlIdMin = 890942;
    $urlIdMax = 909964;

    // loop
    $done = false;
    while ($done == false) {
        // wylosuj nowe url z zakresu
        $randomUrlId = rand($urlIdMin, $urlIdMax);
        $randomUrl = $urlBase . $randomUrlId;
        if (sprawdzUrl($randomUrl, $DBH, true, true, true)) {
            $url = $randomUrl;
            $done = true;
        }
    }
    return $url;
}
function wylozujZapisaneUrl($DBH)
{
    $url = "";
    // zdobądź zapisane url
    $STH = $DBH->prepare("SELECT `url` FROM `zapisane`");
    $STH->execute();
    $savedUrls = $STH->fetchAll(PDO::FETCH_COLUMN);
    $done = false;
    while ($done == false) {
        // wylosuj losowy url z zapisanych
        $randomKey = array_rand($savedUrls, 1);
        $randomUrl = $savedUrls[$randomKey];
        // jeżeli nie ma go w załadowanych to wprowadź
        if (sprawdzUrl($randomUrl, $DBH, false, false, true)) {
            $done = true;
            $url = $randomUrl;
        }
    }

    return $url;
}
function wprowadzUrlDoBazy($DBH, $url)
{
    // zdobądź dane z url
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // wprowadź dane do bazy
    $data = array($response, $url);
    $STH = $DBH->prepare("INSERT INTO api(id, json, url) VALUES (null,?, ?)");
    $STH->execute($data);
    return "sukces";
}
function wprowadzUrlDoZapisanych($DBH, $url)
{
    $data = array($url);
    $STH = $DBH->prepare("INSERT INTO zapisane(id, url) VALUES (null,?)");
    $STH->execute($data);
}
function sprawdzUrl($url, $DBH, $curl, $zapisane, $zaladowane)
{
    if ($curl == true) {
        // jeżeli nie zwraca 200 to niepoprawny
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $response = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($status !== 200) {
            return false;
        }
    }
    if ($zapisane == true) {
        // jeżeli jest w zapisanych to niepoprawny
        $STH = $DBH->prepare("SELECT `url` FROM `zapisane`");
        $STH->execute();
        $zapisaneUrl = $STH->fetchAll(PDO::FETCH_COLUMN);
        if (in_array($url, $zapisaneUrl)) {
            return false;
        }
    }
    if ($zaladowane == true) {
        // jeżeli jest w załadowanych to niepoprawny
        $STH = $DBH->prepare("SELECT `url` FROM `api`");
        $STH->execute();
        $zadalowaneUrl = $STH->fetchAll(PDO::FETCH_COLUMN);
        if (in_array($url, $zadalowaneUrl)) {
            return false;
        }
    }

    return true;
}
function sprawdzZapis($DBH, $ilosc)
{
    $STH = $DBH->prepare("SELECT `url` FROM `zapisane`");
    $STH->execute();
    $zapisaneUrl = $STH->fetchAll(PDO::FETCH_COLUMN);
    $STH = $DBH->prepare("SELECT `url` FROM `api`");
    $STH->execute();
    $zadalowaneUrl = $STH->fetchAll(PDO::FETCH_COLUMN);

    // policz niezaładowane zapisane (ile można z tamtąd wziąć)
    $index = 0;
    $dostepne = 0;
    if (count($zapisaneUrl) > $ilosc) {
        while ($dostepne < $ilosc) {
            if (!in_array($zapisaneUrl[$index], $zadalowaneUrl)) {
                $dostepne++;
            }
            $index++;
        }
    }
    if ($dostepne >= $ilosc) {
        return true;
    } else {
        return false;
    }
}

// główny
if (isset($_POST["autoLos"]) && $_POST["autoLos"] == "true") {
    if (isset($_POST["autoLosTyp"]) && $_POST["autoLosTyp"] == "zapisany") {
        if (sprawdzZapis($DBH, $_POST["autoLosIle"])) {
            for ($i = 0; $i < $_POST["autoLosIle"]; $i++) {
                $url = wylozujZapisaneUrl($DBH);
                $customStatus = wprowadzUrlDoBazy($DBH, $url);
            }
        } else {
            $customStatus = "za mało zapisanych url";
        }
    }
    if (isset($_POST["autoLosTyp"]) && $_POST["autoLosTyp"] == "nowy") {
        for ($i = 0; $i < $_POST["autoLosIle"]; $i++) {
            $url = wylosujNoweUrl($DBH);
            $customStatus = wprowadzUrlDoBazy($DBH, $url);
            wprowadzUrlDoZapisanych($DBH, $url);
        }

    }

} elseif (isset($_POST["manLos"]) && $_POST["manLos"] == "true") {
    if (isset($_POST["manLosTyp"]) && $_POST["manLosTyp"] == "zapisany") {
        if (sprawdzZapis($DBH, 1)) {
            $url = wylozujZapisaneUrl($DBH);
            $returnUrl = $url;
        } else {
            $customStatus = "za mało zapisanych url";
        }

    }
    if (isset($_POST["manLosTyp"]) && $_POST["manLosTyp"] == "nowy") {
        $url = wylosujNoweUrl($DBH);
        wprowadzUrlDoZapisanych($DBH, $url);
        $returnUrl = $url;
    }
    if (isset($_POST["manLosTyp"]) && $_POST["manLosTyp"] == "wyslij") {
        $url = $_POST["manLosUrl"];
        if (sprawdzUrl($url, $DBH, true, false, true)) {
            $customStatus = wprowadzUrlDoBazy($DBH, $url);
        } else {
            $customStatus = "złe url";
        }
    }
} elseif (isset($_POST["usunBaza"]) && $_POST["usunBaza"] == "zaladowane") {
    $STH = $DBH->prepare("truncate api");
    $STH->execute();
    $customStatus = "Usunięto";
} elseif (isset($_POST["usunBaza"]) && $_POST["usunBaza"] == "zapisane") {
    $STH = $DBH->prepare("truncate zapisane");
    $STH->execute();
    $customStatus = "Usunięto";
}

header("location: ../dane.php?customStatus=" . urlencode($customStatus) . "&returnUrl=" . urldecode($returnUrl));
?>