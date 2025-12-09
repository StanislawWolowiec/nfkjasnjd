<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    
</head>

<body>
    <?php
    include("skrypty/funkcje.php");
    $DBH = new PDO("mysql:host=localhost;dbname=komputa", "root", "");
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    ?>

    <div class="header">
        <div class="header2" style="width: 65%; justify-content: left;">
            <img src="grafika/logo.svg" alt="">
            <form action="skrypty/przekierowanie.php" method="post" class="searchForm">
                <input type="text" name="nazwa" class="searchbar">
                <input type="hidden" name="productId" value="<?php print ("dane"); ?>">
                <select name="kategoria" id="">
                    <option value="">wybierz kategorię</option>
                    <?php
                    $kategorie = DB($DBH, "SELECT kategoria FROM wczytane", false);
                    $kategorie = $kategorie->fetchAll(PDO::FETCH_COLUMN);
                    $kategorie = array_unique($kategorie);
                    $kategorie = array_values($kategorie);
                    for ($i = 0; $i < count($kategorie); $i++) {
                        print ("<option name='' value='" . $kategorie[$i] . "'>" . $kategorie[$i] . "</option>");
                    }
                    ?>
                </select>
                <button class="lupa"></button>
                </form>
                </div>
                <div class="header2" style="width: 35%; justify-content: right;">
            <button class="grejbaton" onclick="KoszykClick()">Koszyk</button>
            <button class="grejbaton"></button>
            <button class="grejbaton"></button>
            <button class="grejbaton"></button>
            <button class="grejbaton"></button>
        </div>
    </div>
    <div class="header" style="background-color: rgb(231, 231, 231);">
        <p><a href="biblioteka.php">biblioteka</a></p>
        <p><a href="dane.php">dodawanie danych</a></p>
        <p><a href="podsumowanie.php">Podsumowanie</a></p>
        <p><a href="kategorie.php">wyświetl kategorie</a></p>
        <p>kategoria5</p>
    </div>

    <main>
        <div class="panel">
            <h1>Dodaj losowe</h1>
            <div class="inpanel">
                <form action="skrypty/dodawanieDanych.php" method="POST">
                    <button name="Typ" value="losowe" type="submit">Dodaj</button>
                    <input type="number" name="LiczbaLosowych" value="1" style="width: 15%;">
                </form>
            </div>
        </div>
        <div class="panel">
            <h1>Dodaj poprzez url</h1>
            <div class="inpanel">
                <form action="skrypty/dodawanieDanych.php" method="POST">
                    <button name="Typ" value="url" type="submit">Dodaj</button>
                    <input type="text" name="url" value="" style="width: 100%;">
                </form>
            </div>
        </div>
        <div class="panel">
            <h1>Wyczyść bazę</h1>
            <div class="inpanel">
                <form action="skrypty/usuwanieDanych.php" method="POST">
                    <input type="hidden" name="back" value="<?php print ($_SERVER['REQUEST_URI']); ?>">
                    <button name="Typ" value="wszystko" type="submit">Wyczyść</button>
                </form>
            </div>
        </div>
        <div class="panel">
            <div class="inpanel">

            </div>
        </div>
    </main>
    <?php
    $koszykOtwarty = isset($_GET['koszyk']) ? boolval($_GET['koszyk']) : false;
    ?>
    <div class="koszyk" style="display: <?= $koszykOtwarty ? 'flex' : 'none' ?>;">
        <h1>Koszyk</h1>
        <ul>
            <?php

            $koszyk = DB($DBH, "SELECT * FROM koszyk", false);
            $koszyk = $koszyk->fetchAll(PDO::FETCH_ASSOC);

            $calkosz = 0;
            foreach ($koszyk as $produkt) {

                $productData = DB($DBH, "SELECT json FROM wczytane WHERE id=?", array($produkt["product_id"]));
                $productData = $productData->fetch(PDO::FETCH_COLUMN);
                $productData = json_decode($productData, true);
                print ("<li class='koszykprodukt'>");
                print ("<div style='display:flex;flex-direction: row;'>");
                print ("<div style='width:25%'>");
                print ("<img src='" . $productData["gallery"]["pictures"][0]["sizeS"]["url"] . "' alt=''>");
                print ("</div>");
                print ("<div style='display:flex;flex-direction: column;width:70%'>");
                print ("<p>" . $productData["basicInfo"]["name"] . "</p>");
                print ("<p>" . $productData["price"]["final"]["gross"]["formatted"] . "</p>");
                print ("</div>");
                print ("<form action='skrypty/zarzKoszyk.php' method='post'>");
                print ("<input type='hidden' name='back' value='" . $_SERVER['REQUEST_URI'] . "'>");
                print ("<button style='border-radius:15px; border:1px solid black; height:100%' name='usun' value='" . $produkt["id"] . "'>x</button>");
                print ("</form></div></li>");
                $calkosz += $productData["price"]["final"]["gross"]["raw"];
            }

            ?>
        </ul>
        <h2>Całkowity koszt:</h2>
        <h2><?php print ($calkosz) ?> zł</h2>
        <a href="podsumowanie.php"><button>Zapłać</button></a>
    </div>
    
    <script src="skrypty/koszyk.js"></script>
    <script src="skrypty/przyciski.js"></script>
    <?php
    $DBH = null;
    ?>
</body>

</html>