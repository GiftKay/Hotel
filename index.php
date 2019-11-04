<?php 
    require "logic.php";
    //startup file
    try{
        $logic = new Logic();
        $pdo = $logic->db_context();
        header("Location: views/home.php");
    }
    catch(PDOException $e){
        session_start();
        $_SESSION['error_message'] = $e->getMessage();
        header("Location: views/error.php");
    }
    
?>

