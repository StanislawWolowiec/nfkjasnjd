<?php
    try {
        $DBH = new PDO("mysql:host=localhost;dbname=komputa", "root", "");
        $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        
        $STH = $DBH->prepare("truncate api");
        $STH->execute();
    }
        catch(PDOException $e) {
        echo $e->getMessage();
    }
    header("Location: dane.php");
?>