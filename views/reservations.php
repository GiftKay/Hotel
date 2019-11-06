<?php 
    require "../logic.php";
    $logic = new Logic();
    $reservations = $logic->get_reservations();
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
<div class="container jumbotron mt-3">
    <h1 class="text-center">Reservation Details</h1>
   <div class="row mt-3">
        <div class="col-12">
            <table class="table table-sm">
                <thead>
                    <tr>
                       <th>Reservation ID</th>
                       <th>First Name</th>
                       <th>Last Name</th>
                       <th>Phone Number</th>
                       <th>Email</th>
                       <th>Breakfast</th>
                       <th>Check In</th>
                       <th>Check Out</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($reservations as $reservation)  {?>
                        <tr>
                            <td>#<?= $reservation->reservation_id ?></td>
                            <td><?= $reservation->first_name ?></td>
                            <td><?= $reservation->last_name ?></td>
                            <td><?= $reservation->cell ?></td>
                            <td><?= $reservation->email ?></td>
                            <td><?= $reservation->breakfast($reservation->breakfast) ?></td>
                            <td><?= $reservation->check_in ?></td>
                            <td><?= $reservation->check_out ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="home.php" class="btn btn-sm btn-secondary">Back</a>
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
