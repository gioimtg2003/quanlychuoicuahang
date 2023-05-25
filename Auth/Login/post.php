<?php
@session_start();
require_once __DIR__ . '/../../database/setup/connectDB.php';
class login extends ConnectDB
{
    private $username;
    private $password;
    public function __construct(string $username, string $password)
    {
        parent::__construct();
        $this->username = $username;
        $this->password = $password;
    }
    /**
     * kiểm tra đã kết nối được chưa
     */
    public function check_connect(): mixed
    {
        $pdo = $this->connect();
        return $pdo;
    }
    /**
     * trả về lệnh sql tìm kiếm tài khoản có user name và password giống trong database
     */
    public function statment_sql()
    {
        return "SELECT * FROM account WHERE userName = '$this->username' AND password = '$this->password'";
    }
    /**
     * Kiểm tra tài khoản trong database
     */
    public function check_account(){
        try {
            $pdo = $this->check_connect();
            $sql = "SELECT * FROM account WHERE userName = '$this->username' AND password = '$this->password'";
            $stmt = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            return count($stmt) > 0 ? $stmt[0]['id'] : false;
        } catch (PDOException $e) {
            echo "Sai tài khoản hoặc mật khẩu";
            $e->getMessage();
        }
    }
}
?>