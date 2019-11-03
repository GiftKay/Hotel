<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hotel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <link rel="stylesheet" href="css/bootstrap.css"/>
    <script src="main.js"></script>
</head>
<body>
<div class="container mt-3">
    <h3 class="text-center">HOTEL</h3>
    <hr/>
    <form action="" method="POST">
        <div class="form-group">
            <div class="row">
                <div class="col-3">
                    <label>Place</label>
                    <input class="form-control" type="text" name="city" placeholder="Enter a City">
                </div>
                <div class="col-4">
                    <label>Dates</label><br/>
                    <div class="row">
                        <div class="col">
                            <input class="form-control" type="date" name="sdates">
                        </div>-
                        <div class="col">
                            <input class="form-control" type="date" name="edates">
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <label>Room Type</label>
                    <select class="form-control">
                        <option>Single Room</option>
                        <option>Double Room</option>
                        <option>Family Room</option>
                    </select>
                </div>
                <div class="col-3">
                <div class="mb-0">
                    <button class="btn btn-primary form-control" type="submit" name="search">Search</button>
                </div>
                </div>
            </div>
        </div>
    </form>
</div>

    <?php 
    //startup file
    try{
        $host = 'localhost';
        $dbName = 'hotelDb';
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
</body>
</html>

