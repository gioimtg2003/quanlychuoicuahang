<?php
require_once __DIR__ . '/../api/postData.php';
class buildDB{
    private $nameHost;
    private $nameUser;
    private $password;
    public function __construct($nameHost, $nameUser, $password){
        $this->nameHost = $nameHost;
        $this->nameUser = $nameUser;
        $this->password = $password;
    }
    public function connect() {
        $conn = new mysqli($this->nameHost, $this->nameUser, $this->password);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
    public function createDB($conn, $nameDB){
        $sql = "CREATE DATABASE IF NOT EXISTS $nameDB;";
        if ($conn->query($sql) === TRUE) {
            echo "Database created successfully" ."\n";
        } else {
            echo "Error creating database: " .$conn->error;
            return false;
        }
    } 
}
$newDB = new buildDB("localhost", "root", "");
$conn = $newDB->connect();
$newDB->createDB($conn, "quanlychuoicuahang");
$conn->close();
$createTable = new postData();
$createTable->postData("createTableAndInsertData");
?>