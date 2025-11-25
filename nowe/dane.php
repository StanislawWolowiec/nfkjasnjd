<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="biblioteka.php">bibiloteka</a>
    <h2>LOSOWE</h2>
    <form action="dodawanie.php" method="POST">
        URL: <input type="text" name="url" id="losowe" style="width:375px"><br>
        <input type="submit">
    </form>
    <button onclick="losuj()">wylosuj</button><br>
    
    <script>
    function losuj() {
        let range = [820942, 909964]
        let min = range[0]
        let max = range[1]
        let randNum = Math.floor(Math.random() * (max - min + 1)) + min;
        let url = "https://www.komputronik.pl/api/front/v1/pages/product/" + randNum
        document.querySelector("#losowe").value = url
    }
    </script>
    <h2>Wyczyść całą bazę</h2>
    <form action="usunBaza.php">
        <input type="submit" value="tak">
    </form>
</body>
</html>