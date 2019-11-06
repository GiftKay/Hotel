<?php 
    require "../logic.php";
    $logic = new Logic();
    $rooms =  $logic->get_rooms();
    $roomsd =  $logic->get_rooms();
    $branches =  $logic->get_branches();

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $branch_id = $_POST["branch_id"];
        $room_type = $_POST["room_type"];
        session_start();
        $_SESSION['date_in']=$_POST["check_in"];
        $_SESSION['date_out']=$_POST["check_out"];
        
        $check_in = $_POST["check_in"];
        $check_out = $_POST["check_out"];
        $roomsd = $logic->search_rooms($branch_id,$room_type);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hotel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.css"/>
    <link rel="stylesheet" href="../css/flatpickr.css"/>
</head>
<body class="bg-light">
<div class="container mt-3 ">
    <h3 class="text-center">HOTEL</h3>
    <div class="pl-2 pr-2">
        <form class="form-horizontal  pt-2 pb-2" action="" method="POST">
            <div class="form-group">
                <div class="row">
                    <div class="col-2">
                        <label>City</label>
                        <select class="form-control" name="branch_id">
                            <option value="0">-- Select --</option>
                            <?php foreach($branches as $branch){ ?>
                                <option value="<?= $branch[0];?>"><?= $branch[2];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-5" id="dates_range">
                        <label>Dates</label><br/>
                        <div class="row">
                            <div class="col">
                                <input class="form-control" type="text" id="dates">
                                <input class="form-control" type="hidden" name="check_in" id="check_in">
                                <input class="form-control" type="hidden" name="check_out" id="check_out">
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <label>Room Type</label>
                        <select class="form-control" name="room_type">
                            <option value="">-- Select --</option>
                            <?php foreach($rooms as $room){ ?>
                                <option value="<?= $room[4];?>"><?= $room[4];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-3 mt-4 pt-2">
                        <button class="btn btn-primary form-control rounded-pill" type="submit">Search</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <hr class="pt-0 mt-0"/>
    <div class="col-md-12" id="listDiv">
        <?php foreach($roomsd as $room){ ?>
            <div class="border col-12 mb-3">
                <div class="row">
                    <div class="col-5 pl-0">
                        <img src="<?= $room[5]?>" width="100%"/>
                    </div>
                    <div class="col-7 mt-2">
                        <h4 class="d-inline text-info">R <?= $room[3] ?></h4> - <p class="d-inline"><?= $room[4] ?> </p>
                        <hr/>
                        <p><?=$room[2]?></p>
                        <div class="mr-2 mb-2 row">
                            <div class="col-9"><hr/></div>
                            <div class="col-3">
                                <a href="view.php?id=<?= $room[0] ?>" class="btn btn-success btn-sm btn-block" type="submit" name="View" >VIEW</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <footer class="text-center bg-light">
        <hr/>
        <p>Siphokuhle Khanyile<br>
        © Copyright 
        <?=$currentDateTime= date('Y');?></p>
        <script src="../js/jquery.js"></script>
        <script src="../js/moment.js"></script>
        <script src="../js/flatpickr.js"></script>
        <script src="../js/custom.js"></script>
    </footer>
</div>
</body>
</html>

