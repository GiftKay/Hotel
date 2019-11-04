<?php
    session_start();
    if(isset($_SESSION["error_message"]))
    { 
        $msg = $_SESSION["error_message"]; 
    } 
    else { 
        $msg = "No error message"; 
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hotel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <link rel="stylesheet" href="../css/bootstrap.css"/>
    <script src="main.js"></script>
</head>
<body>
    
    <div class="container mt-5">
        <div class="alert alert-danger">
            <?php echo $msg ?>
        </div>
    </div>
</body>
</html>

