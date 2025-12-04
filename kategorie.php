<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteka</title>
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
                <input type="hidden" name="productId" value="<?php print ("kategorie"); ?>">
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
            <button class="grejbaton"></button>
            <button class="grejbaton"></button>
            <button class="grejbaton"></button>
            <button class="grejbaton"></button>
            <button class="grejbaton"></button>
        </div>
    </div>
    <div class="header" style="background-color: rgb(231, 231, 231);">
        <p><a href="biblioteka.php">biblioteka</a></p>
        <p><a href="dane.php">dodawanie danych</a></p>
        <p><a href="kategorie.php">wyświetl kategorie</a></p>
        <p>kategoria4</p>
        <p>kategoria5</p>
    </div>
    <div class="duzygrid">
        <?php
        try {
            $kategorie = DB($DBH, "SELECT kategoria FROM wczytane", false);
            $kategorie = $kategorie->fetchAll(PDO::FETCH_COLUMN);
            $kategorie = array_unique($kategorie);
            $kategorie = array_values($kategorie);

            for ($i = 0; $i < count($kategorie); $i++) {
                print ("<a href='biblioteka.php?kategoria=" . $kategorie[$i] . "'>");
                print ("<div class='bibliotekaProdukt'>");
                print ("<h5>" . $kategorie[$i] . "</h5>");
                print ("</div>");
                print ("</a>");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        ?>
    </div>
</body>

</html>