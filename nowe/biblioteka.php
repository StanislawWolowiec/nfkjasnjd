<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteka</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="dane.php">dodawanie danych</a>
    <div class="duzygrid">
        <?php
        try {
            $DBH = new PDO("mysql:host=localhost;dbname=komputa", "root", "");
            $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

            $STH = $DBH->query('select * from api');
            $STH->setFetchMode(PDO::FETCH_ASSOC);;

            $i = 0;
            while($row = $STH->fetch()) {
                $jsonrow = json_decode($row['json'], true);
                $id = json_decode($row['id'], true);
                print("<a href='index.php?productId=".$i."'><div class='bibliotekaProdukt'>");
                print("<img src='".$jsonrow["gallery"]["pictures"][0]["sizeXL"]["url"]."' alt=''>");
                print("<h5>".$jsonrow["basicInfo"]["name"]."</h5>");
                print("<form action='usunJedno.php' method='post'><input type='hidden' name='id' value=".$id."><input type='submit' value='x'></form>");
                print("</div></a>");
                $i += 1;
            }
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
        ?>
    </div>
</body>
</html>