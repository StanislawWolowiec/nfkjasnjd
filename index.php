<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sklep</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include("skrypty/funkcje.php");
    try {
        $DBH = new PDO("mysql:host=localhost;dbname=komputa", "root", "");
        $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        $STH = $DBH->query('select id from wczytane');
        $ids = $STH->fetchAll(PDO::FETCH_COLUMN);

        $STH = $DBH->query('select * from wczytane');
        $totalRecords = $STH->rowCount() - 1;
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }

    $productId = isset($_GET['productId']) ? intval($_GET['productId']) : 1;
    if ($productId > $totalRecords or $productId < 1) {
        $productId = 1;
    }
    $nextId = $productId + 1;
    if ($nextId > $totalRecords or $nextId < 1) {
        $nextId = 1;
    }
    
    try {
        $STH = $DBH->query('select json from wczytane where id = ' . $productId . '');
        $STH->setFetchMode(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    if ($row = $STH->fetch()) {
        $jsonString = $row['json'];
        //echo "JSON String: " . $jsonString;

        $jsonData = json_decode($jsonString, true);
        //print_r($jsonData);
        
    } 
    else {
        echo "No record found.";
    }
    ?>
    <div class="header">
        <div class="header2" style="width: 65%; justify-content: left;">
            <img src="grafika/logo.svg" alt="">
            <form action="skrypty/przekierowanie.php" method="post" class="searchForm">
                <input type="text" name="nazwa" class="searchbar">
                <input type="hidden" name="productId" value="<?php print ($productId); ?>">
                <select name="kategoria" id="">
                    <option value="">wybierz kategorię</option>
                    <?php
                    $kategorie = DB($DBH, "SELECT kategoria FROM wczytane", false);
                    $kategorie = $kategorie->fetchAll(PDO::FETCH_COLUMN);
                    $kategorie = array_unique($kategorie);
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
    <h1 id="nazwaproduktu"><?php print($jsonData["basicInfo"]["name"]); ?></h1>   
    <div id="main">
        <div id="obrazproduktu">
            <?php
            print("<img src='".$jsonData["gallery"]["pictures"][0]["sizeXL"]["url"]."'alt='' id='obrazek'>");
            ?>
        </div>
        <div id="opisproduktu">
            <div id="kody">
                <h5>Kody:</h5>
                <ul>
                <?php
                foreach ($jsonData["codes"] as $codeTable) {
                    print("<li>".$codeTable["type"].": ".$codeTable["code"]."</li>");
                }
                ?>
                </ul>
                
            </div>
            <div id="spece">
                <h4>Specyfikacje:</h4>
                <?php
                $rozKategoria = 0;
                foreach ($jsonData["specification"] as $specTable) {
                    print("<h5>".$specTable["name"]."</h5>");
                    print("<button class='"."rozButton".$rozKategoria."' onclick='roz(".$rozKategoria.")'>Rozwiń</button>");

                    print("<ul class='"."rozLista rozLista".$rozKategoria."'>");
                    foreach ($specTable["attributes"] as $attribute) {
                        print("<li>");
                        print($attribute["name"]);
                        print(": ");
                        print($attribute["values"][0]["name"]);
                        print("</li>");
                    }
                    print("</ul>");
                    $rozKategoria += 1;
                }
                ?>
            </div>
        </div>
        <div id="kupowanie">
            <h1 id="cena"><?php print($jsonData["price"]["final"]["gross"]["formatted"]) ?></h1>
            <?php print("<a href='?productId=".$nextId."'>"); ?>
            <button id="kup" type="button" onclick="batonClick()"><h1 style="color:white; font-style: bold;">kup</h1></button>
            <?php print("</a>"); ?>
            <p id="dostawa">dostawa</p>
        </div>
    </div>
    <div class="opis">
        <?php
        foreach ($jsonData["descriptions"] as $desc) {
            print($desc);
        }
        ?>
    </div>
    <script src="skrypty/przyciski.js"></script>
    <?php
    $DBH = null;
    ?>
</body>

</html>