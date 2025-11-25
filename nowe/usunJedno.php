<?php
    $id = $_POST['id'];
    try {
        $DBH = new PDO("mysql:host=localhost;dbname=komputa", "root", "");
        $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        
        $STH = $DBH->prepare("delete from api where id = ".$id);
        $STH->execute();
    }
        catch(PDOException $e) {
        echo $e->getMessage();
    }
    header("Location: biblioteka.php");
?>