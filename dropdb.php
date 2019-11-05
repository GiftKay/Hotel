<?php
    require "logic.php";
    //startup file
    try{
        $logic = new Logic();
        $pdo = $logic->db_context();
        $pdo->exec('DROP DATABASE hotel_db');
    }
    catch(PDOException $e){
        session_start();
        $_SESSION['ERROR_MESSAGE'] = $e->getMessage();
        die($e->getMessage());
    }
?>