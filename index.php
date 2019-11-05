<?php 
    require "logic.php";
    //startup file
    try{
        $logic = new Logic();
        $pdo = $logic->db_context();
        header("Location: views/home.php");
    }
    catch(PDOException $e){
        $logic->error_handler($e->getMessage());
    }
    
?>

