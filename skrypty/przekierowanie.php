<?php

$url = "../biblioteka.php";
$params = [];

if (!empty($_POST["nazwa"])) {
    $params["nazwa"] = $_POST["nazwa"];
}

if (!empty($_POST["kategoria"])) {
    $params["kategoria"] = $_POST["kategoria"];
}

if (!empty($params)) {
    $url .= "?" . http_build_query($params);
} else {
    $url = "../index.php?productId=" . $_POST["productId"];
}
print ($url);
header("Location: $url");
exit;

?>