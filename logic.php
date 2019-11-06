<?php

class Logic
{
    public function db_context()
    {
        $host = 'localhost';
        $dbName = 'hotel_db';
        $user = 'root';
        $password = '';
        $pdo = new PDO("mysql:host=$host;", $user, $password);
        if($this->db_exist($pdo, $dbName) ==false)
        {
            $pdo->exec("CREATE DATABASE $dbName");
            $pdo = new PDO("mysql:host=$host; dbname=$dbName", $user, $password);  
            $this->create_tables($pdo);
        }
        $pdo = new PDO("mysql:host=$host; dbname=$dbName", $user, $password);  
        return $pdo;     
    }

    public function create_tables($pdo)
    {
        $b = $pdo->exec("CREATE TABLE branches(
            branch_id INT PRIMARY KEY,
            branch_name VARCHAR(255) NOT NULL,
            city VARCHAR(255) NOT NULL,
            address VARCHAR(255) NOT NULL
        )");

        $r = $pdo->exec("CREATE TABLE rooms (
            room_id INT PRIMARY KEY,
            room_quantity INT NOT NULL,
            description VARCHAR(255) NOT NULL,
            price DECIMAL NOT NULL,
            room_type VARCHAR(255) NOT NULL,
            image_url VARCHAR(255) NOT NULL,
            branch_id INT NOT NULL,
            FOREIGN KEY(branch_id) REFERENCES branches(branch_id)
        )");

        $res = $pdo->exec("CREATE TABLE reservations (
            reservation_id INT AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(255) NOT NULL,
            last_name VARCHAR(255) NOT NULL,
            cell VARCHAR(12) NOT NULL,
            email VARCHAR(255) NOT NULL,
            breakfast BOOLEAN NOT NULL,
            check_in DATETIME NOT NULL,
            check_out DATETIME NOT NULL,
            room_id INT NOT NULL,
            FOREIGN KEY(room_id) REFERENCES rooms(room_id)
        )");
        $this->seed_database($pdo);
        
    }

    public function seed_database($pdo)
    {
        $b = $pdo->exec("INSERT INTO branches VALUES
            (1,'Hotel Premium','Pietermaritzburg','15 Grobler Crescent, Westgate, 3201'),
            (2,'Hotel Towers','Durban','478 Anton Lembede street, 4001'),
            (3,'Hotel Elite','Johanesburg','15 Towning Street, Randburg, 1700')
        ");

        $r = $pdo->exec("INSERT INTO rooms VALUES
            (1,30,'Comes with air conditioning, Flat Screen TV, Pool',1349.99,'Single Room','../images/1.jpg',1),
            (2,30,'Comes with air conditioning, Flat Screen TV, Pool',1349.99,'Single Room','../images/1.jpg',2),
            (3,30,'Comes with air conditioning, Flat Screen TV, Pool',1349.99,'Single Room','../images/1.jpg',3),
            (4,25,'Comes with air conditioning, Flat Screen TV, Pool, jacoozy, city view',2500,'Double Room','../images/2.jpg',1),
            (5,25,'Comes with air conditioning, Flat Screen TV, Pool, jacoozy, city view',2500,'Double Room','../images/2.jpg',2),
            (6,25,'Comes with air conditioning, Flat Screen TV, Pool, jacoozy, city view',2500,'Double Room','../images/2.jpg',3),
            (7,15,'Comes with air conditioning, Flat Screen TV, Pool, jacoozy, ocean view, city view',10500,'Family Room','../images/3.jpg',1),
            (8,15,'Comes with air conditioning, Flat Screen TV, Pool, jacoozy, ocean view, city view',10500,'Family Room','../images/3.jpg',2),
            (9,15,'Comes with air conditioning, Flat Screen TV, Pool, jacoozy, ocean view, city view',10500,'Family Room','../images/3.jpg',3)
        ");

        if(!$b || !$r)
        {
            session_start();
            $_SESSION['error_message'] = "Error while inserting : braches $b, rooms $r". $pdo->errorInfo()[2];
            header("Location: views/error.php");
        }
    }

    public function db_exist($pdo, $dbName)
    {
        $stmt = $pdo->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbName'");
        return (boolean) $stmt->fetchColumn();
    }
    
    public function get_room_types()
    {
        $pdo = $this->db_context();
        $rooms = $pdo->query("SELECT DISTINCT room_type FROM rooms")->fetchAll(PDO::FETCH_CLASS,'Room');
        return $rooms;
    }
    public function get_rooms()
    {
        $pdo = $this->db_context();
        $rooms = $pdo->query("SELECT * FROM rooms")->fetchAll(PDO::FETCH_CLASS,'Room');
        return $rooms;
    }

    public function get_branches()
    {
        $pdo = $this->db_context();
        $braches = $pdo->query("SELECT * FROM branches")->fetchAll(PDO::FETCH_CLASS,'Branch');
        return $braches;
    }
    public function search_rooms($branch_id, $room_type)
    {
        $pdo = $this->db_context();
        if($room_type=="")
        {
            $rooms = $pdo->query("SELECT * FROM rooms WHERE branch_id=$branch_id")
                     ->fetchAll(PDO::FETCH_CLASS,'Room');
        }
        else if($branch_id==0)
        {
            $rooms = $pdo->query("SELECT * FROM rooms WHERE room_type='$room_type'")
                     ->fetchAll(PDO::FETCH_CLASS,'Room');
        }
        else
        $rooms = $pdo->query("SELECT * FROM rooms WHERE branch_id=$branch_id AND room_type='$room_type'")
                     ->fetchAll(PDO::FETCH_CLASS,'Room');
        return $rooms;
    }

    public function error_handler($msg)
    {
        $_SESSION['error_message'] = $msg;
        header("Location: /hotel/views/error.php");
    }

    public function get_room($room_id)
    {
        $pdo = $this->db_context();
        $room = $pdo->query("SELECT * FROM rooms WHERE room_id=$room_id")->fetchObject('Room');
        return $room;

    }

    public function get_reservations()
    {
        $pdo = $this->db_context();
        $reservations = $pdo->query("SELECT * FROM reservations")->fetchAll(PDO::FETCH_CLASS,'Reservation');
        return $reservations;
    }

    public function create_reservation($firstname,$surname,$cell,$email,$checkIn,$checkOut,$breakfast,$room_id)
    {
        $pdo = $this->db_context();

        $reservation_added = $pdo->exec("INSERT INTO reservations(first_name, last_name, cell, email, breakfast, check_in, check_out, room_id ) 
                                         VALUES ('$firstname','$surname','$cell','$email',$breakfast,'$checkIn','$checkOut',$room_id)"
                                         );

        if($reservation_added == false)
        {
            $this->error_handler($pdo->errorInfo());
        }
        $room_added = $pdo->exec("UPDATE rooms SET room_quantity=room_quantity-1 WHERE room_id=$room_id");       
    }
    public function get_cityname($branch_id)
    {
        $pdo = $this->db_context();
        $branch = $pdo->query("SELECT * FROM branches WHERE branch_id=$branch_id")->fetchObject('Branch');
        return $branch->city;
    }
}

class Room
{
    public $room_id;
    public $room_quantity;
    public $description;
    public $price;
    public $room_type;
    public $image_url;
    public $branch_id;
}

class Branch 
{
    public $branch_id;
    public $branch_name;
    public $city;
    public $address;
}

class Reservation
{
    public $reservation_id;
    public $first_name;
    public $last_name;
    public $cell;
    public $email;
    public $breakfast;
    public $check_in;
    public $check_out;
    public $room_id;

    public function breakfast($b)
    {
        return $b > 0 ? "Yes": "No";
    }
}



?>