<?php
if(!isset($_POST["url"])){
    print("no url");
}
else {
    try {
        $url = $_POST["url"];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $response = curl_exec($ch);
        curl_close($ch);

        //$jsonString = json_decode($response, true);
        $jsonString = $response;

        $DBH = new PDO("mysql:host=localhost;dbname=komputa", "root", "");
        $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        
        $data = array($jsonString);
        $STH = $DBH->prepare("INSERT INTO api(id, json) VALUES (null,?)");
        $STH->execute($data);
    }
        catch(PDOException $e) {
        echo $e->getMessage();
    }
    header("Location: dane.php");
}
?>