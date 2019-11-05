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
            last_name DECIMAL NOT NULL,
            cell VARCHAR(12) NOT NULL,
            email VARCHAR(255) NOT NULL,
            breakfast BOOLEAN NOT NULL,
            check_in DATE NOT NULL,
            check_out DATE NOT NULL,
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
            (2,25,'Comes with air conditioning, Flat Screen TV, Pool, jacoozy, city view',2500,'Double Room','../images/2.jpg',3),
            (3,15,'Comes with air conditioning, Flat Screen TV, Pool, jacoozy, ocean view, city view',10500,'Family Room','../images/3.jpg',2)
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
    
    public function get_rooms()
    {
        $pdo = $this->db_context();
        $data = $pdo->query("SELECT * FROM rooms");
        return $data;
    }

    public function get_branches()
    {
        $pdo = $this->db_context();
        $data = $pdo->query("SELECT * FROM branches");
        return $data;
    }
    public function search_rooms($branch_id, $room_type)
    {
        $pdo = $this->db_context();
        $data = $pdo->query("SELECT * FROM rooms WHERE branch_id=$branch_id OR room_type='$room_type'");
        // echo "SELECT * FROM rooms WHERE branch_id=$branch_id OR room_type='$room_type'";
        // die();
        return $data;
    }

    public function error_handler($msg)
    {
        session_start();
        $_SESSION['error_message'] = $msg;
        header("Location: /hotel/views/error.php");
    }

    public function get_room($room_id)
    {
        $pdo = $this->db_context();
        $room = $pdo->query("SELECT * FROM rooms WHERE room_id=$room_id")->fetchObject('Room');
        return $room;

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

?>