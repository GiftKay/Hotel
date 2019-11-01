<?php 
    //startup file;
    try{
        $host = 'localhost';
        $dbName = 'hotelDb11';
        $user = 'root';
        $password = '';
        $pdo = new PDO("mysql:host=$host;", $user, $password);
        $pdo->exec("CREATE DATABASE IF NOT EXISTS hotelDb");
        $pdo = new PDO("mysql:host=$host; dbname=$dbName", $user, $password);
    }
    catch(PDOException $e){
        session_start();
        $_SESSION['ERROR_MESSAGE'] = $e->getMessage();
        header("Location: views/error.php");
    }
    
?>