<?php
require_once __DIR__ . '/../setup/connectDB.php';
class postData extends ConnectDB
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * POST dữ liệu vào database
     * @arg tham số truyền vào để xử lý
     * @typeData loại dữ liệu cần xử lý
     */
    public function postData($typeData, ...$arg)
    {
        $stmt = $this->connect();
        switch ($typeData) {
            case "register":
                $sql = "INSERT INTO account (id, userName, password, email, address, phone, name, gtinh, user_admin) VALUES(NULL, '$arg[0]', '$arg[1]', '$arg[2]', '$arg[3]', '$arg[4]', '$arg[5]', '$arg[6]', 0)";
                try {
                    $stmt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    return $stmt->exec($sql) == 1 ? true : false;
                } catch (PDOException $e) {
                    if ($e->getCode() == 23000) {
                        echo "<script>alert('Tên đăng nhập đã tồn tại')</script>";
                        return false;
                    }
                }
                break;
                
            case "login":
                $sql = "SELECT * FROM account WHERE userName = '$arg[0]' AND password = '$arg[1]'";
                try {
                    $stmt = $stmt->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                    return count($stmt) > 0 ? $stmt[0]['id'] : false;
                } catch (PDOException $e) {
                    echo "Error Login: " . $e->getMessage();
                    
                    return false;
                }

            case "loginAdmin":
                $sql = "SELECT * FROM account WHERE userName = '$arg[0]' AND password = '$arg[1]' AND user_admin = 1";
                try {
                    $stmt = $stmt->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                    return count($stmt) > 0 ? $stmt[0]['id'] : false;
                } catch (PDOException $e) {
                    echo "Error Login: " . $e->getMessage();
                    return false;
                }

            case "order":
                break;

            case "createTableAndInsertData":
                $sql = file_get_contents(__DIR__ . '/../setup/createTable.sql');
                try {
                    $stmt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $stmt->exec($sql);
                    echo "Create table successfully";
                       
                } catch (PDOException $e) {
                    echo "Error creating table: " . $e->getMessage() ;
                    return false;
                }
        }
    }
}
?>