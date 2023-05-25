<?php

require_once __DIR__ .'/../setup/connectDB.php';
class getInfoUser extends ConnectDB{
    public function __construct(){
        parent::__construct();
    }
    /**
     * Lấy thông tin tài khoản của người dùng bằng cách truy vấn theo id người dùng
     */
    public function getInfo($id){
        $sql = "SELECT * FROM account WHERE id = $id";
        $stmt = $this->connect();
        return $stmt->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
$get = new getInfoUser();
 ?>