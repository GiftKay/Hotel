<?php 
    require "../logic.php";
    $logic = new Logic();
    $rooms =  $logic->get_rooms();
   
    $branches =  $logic->get_branches();

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
<div class="container mt-3">
    <h3 class="text-center">HOTEL</h3>
    <hr/>
    <form class="form-horizontal mb-4" action="" method="POST">
        <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <label>City</label>
                    <select class="form-control">
                        <?php foreach($branches as $branch){ ?>
                            <option value="<?= $branch[2];?>"><?= $branch[2];?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-5">
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
                        <?php foreach($rooms as $room){ ?>
                            <option value="<?= $room[4];?>"><?= $room[4];?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-3 mt-4 pt-2">
                    <button class="btn btn-primary form-control" type="submit" name="search">Search</button>
                </div>
            </div>
        </div>
    </form>
    <hr/>
</div>
</body>
</html>

