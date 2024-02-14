<?php
try{
    $db = new PDO('mysql:host=localhost;dbname=tuto_php', 'root','');  // Connect to MySQL database server (localhost) and select the database tuto_php
    $db->exec('SET NAMES "UTF8"');
}catch(PDOException $e){
    echo 'Error : '. $e->getMessage();
    die();
}

?>