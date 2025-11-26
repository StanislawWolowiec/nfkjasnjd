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

        if($response == '{"validUrl":"","code":410}' or strlen($response) < 200){
            header("Location: dane.php");
        }
        else {
            $DBH = new PDO("mysql:host=localhost;dbname=komputa", "root", "");
            $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            
            $data = array($response);
            $STH = $DBH->prepare("INSERT INTO api(id, json) VALUES (null,?)");
            $STH->execute($data);
        }
    }
        catch(PDOException $e) {
        echo $e->getMessage();
    }
}
header("Location: dane.php");
?>