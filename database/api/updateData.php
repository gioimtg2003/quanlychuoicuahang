<?php 
require_once __DIR__ . '/../setup/connectDB.php';
class updateData extends ConnectDB{
    public function __construct(){
        parent::__construct();
    }
    /**
     * thay đổi dữ liệu trong database
     * @arg tham số truyền vào để xử lý
     * @typeData loại dữ liệu cần xử lý
     */
    public function updateData($typeData, ...$arg):void{
        $stmt = $this -> connect();
        switch($typeData){
            case 'profile':
                $sql = "UPDATE account SET  `password` = '$arg[0]', email = '$arg[1]', address = '$arg[2]', phone = '$arg[3]', name = '$arg[4]' WHERE `account`.`id` = $arg[5]";
                $stmt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt->exec($sql);
                break;
        }
    }
}
?>