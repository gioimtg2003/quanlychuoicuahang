<?php

require_once __DIR__ . '/../../config/conf.php';
class ConnectDB{
    private $nameHost;
    private $nameUser;
    private $password;
    private $nameDB;
    /**
     * khởi tạo các biến để kết nối database
     */
    public function __construct(){
        $this->nameHost = DB_SERVER;
        $this->nameUser = DB_USERNAME;
        $this->password = DB_PASSWORD;
        $this->nameDB = DB_NAME;
    }
    /**
     * hàm để kết nối database
     */
    public function connect(){
        try {
            $pdo = new PDO("mysql:host=$this->nameHost;dbname=$this->nameDB", $this->nameUser, $this->password);
            // $pdo = new mysqli($this->nameHost, $this->nameUser, $this->password, $this->nameDB);
            return $pdo;
        } catch (PDOException $e){
            $e->getMessage();
        }     
    }
}
?>
