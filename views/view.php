<?php
    require "../logic.php";
    $logic = new Logic();
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $room=$logic->get_room($id);
        if($room == null)
        {
            $logic->error_handler("The room was not found or has been removed");
        }
    }
    else
    {
        $logic->error_handler("Bad request");
    }


    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $firstname = $_POST['firstname'];
        $surname = $_POST['surname'];
        $cell = $_POST['cell'];
        $email = $_POST['email'];
        $checkIn = $_POST['checkIn'];
        $checkOut = $_POST['checkOut'];
        $breakfast = $_POST['breakfast'];

        //insert into resevations
        session_start();
        
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
<body>
<div class="container mt-3">
    <h1 class="text-center">Room Details</h1>
   <div class="row">
        <div class="col-8 m-auto">
            <img src="<?= $room->image_url ?>" width="100%"/>
        <div>
    </div>
    <div class="row">
        <div class="col-12 mt-2">
            <b>Description</b> : <br><p><?= $room->description ?></p>
        </div>
        <div class="col-12">
            <b>Room Type</b> : <br><p><?= $room->room_type ?></p>
        </div>
        <div class="col-12">
            <b>Price</b> : <br><p>R <?= $room->price ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="home.php" class="btn btn-sm btn-secondary">Back</a>
            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#reserveModal">Reserve</button>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="reserveModal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reserve Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" action="" method="POST" id="reserveForm">
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-6">
                                <div class="col-12">
                                    <label for="firstname">First Name </label>
                                    <input type="text" name="firstname" id="firstname" class="form-control"/>
                                    <p class="error text-danger" style="display:none"></p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="col-12">
                                    <label for="surname">Surname </label>
                                    <input type="text" name="surname" id="surname" class="form-control"/>
                                    <p class="error text-danger" style="display:none"></p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-5">
                                <div class="col-12">
                                    <label for="cell">Cell Number</label>
                                    <input type="text" name="cell" id="cell" class="form-control"/>
                                    <p class="error text-danger" style="display:none"></p>
                                </div>
                            </div>

                            <div class="col-7">
                                <div class="col-12">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" class="form-control"/>
                                    <p class="error text-danger" style="display:none"></p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <div class="col-12">
                                    <label for="checkIn">Check In</label>
                                    <input type="text" name="checkIn" id="checkIn" class="form-control" readonly/>
                                    <p class="error text-danger" style="display:none"></p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <div class="col-12">
                                    <label for="checkOut">Check Out</label>
                                    <input type="text" name="checkOut" id="checkOut" class="form-control" readonly/>
                                    <p class="error text-danger" style="display:none"></p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <div class="col-12">
                                    <label for="breakfast">Break Fast</label>
                                    <input type="checkbox" name="breakfast" id="breakfast" />
                                    <p class="error text-danger" style="display:none"></p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit"  class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    <footer class="text-center">
        <hr/>
        <p>Siphokuhle Khanyile<br>
        © Copyright 
        <?=$currentDateTime= date('Y');?></p>
        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap.js"></script>
        <script src="../js/moment.js"></script>
        <script src="../js/flatpickr.js"></script>
        <script src="../js/custom.js"></script>
    </footer>

</div>
</body>
</html>
