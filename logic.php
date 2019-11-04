<?php

class Logic
{
    public function db_context()
    {
        $host = 'localhost';
        $dbName = 'hotel_db1';
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
            (1,30,'Comes with air conditioning, Flat Screen TV, Pool',1349.99,'Single Room',1),
            (2,25,'Comes with air conditioning, Flat Screen TV, Pool, jacoozy, city view',2500,'Double Room',3),
            (3,15,'Comes with air conditioning, Flat Screen TV, Pool, jacoozy, ocean view, city view',10500,'Family Room',2)
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
}

?>