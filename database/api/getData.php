<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once __DIR__ . '/../setup/connectDB.php';
class getData extends ConnectDB
{

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * lấy dữ liệu trong database
     */
    public function getData($typeData, ...$arg)
    {
        $stmt = $this->connect();
        switch ($typeData) {
            // lấy thông tin của người dùng
            case 'profile':
                $sql = "SELECT * FROM account WHERE id = $arg[0]";
                return $stmt->query($sql)->fetchAll(PDO::FETCH_ASSOC);

            // lấy sản tất cả sản phẩm trong chi nhánh
            case 'branch':
                $sql = "SELECT * FROM branch";
                return $stmt->query($sql)->fetchAll(PDO::FETCH_ASSOC);

            // lấy tất cả sản phẩm theo loại
            case 'category':
                $sql = "SELECT * FROM product p JOIN category c ON p.category_id = c.id WHERE p.category_id = $arg[0]";
                $stmt = $this->connect();
                return $stmt->query($sql)->fetchAll(PDO::FETCH_ASSOC);

            // lấy danh sách sản phẩm theo tên
            case 'productName':
                $sql = "SELECT * FROM product WHERE name LIKE '%$arg[0]%'";
                return $stmt->query($sql)->fetchAll(PDO::FETCH_ASSOC);

            // lấy danh sách theo id
            case 'productID':
                $sql = "SELECT * FROM product WHERE id = $arg[0]";
                return $stmt->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function fields($fields)
    {
        header('Content-Type: application/json');
        $stmt = $this->connect();
       

        switch ($fields) {
            //
            case 'cart':
                echo json_encode($_SESSION['cart']);
                break;

            case 'product':
                if (isset($_GET['id']) && count($_GET) <= 2) {
                    $product = $this->getData('productID', $_GET['id']);
                    echo json_encode($product);
                }
                // lấy duy nhất 1 trường trong bảng
                elseif (isset($_GET['id']) && count($_GET) === 3) {
                    $product = $this->getData('productID', $_GET['id']);
                    // lọc ra tên trường cần lấy
                    $filterGet = array_filter($_GET, fn ($key) =>
                    $key != 'id' && $key != 'fields'
                    , ARRAY_FILTER_USE_KEY);
                    // lấy tên trường cần lấy là key
                    $key = array_keys($filterGet)[0];
                    if($_GET[$key] == 'true'){
                        $res = array(
                            $key => $product[0][$key],
                        );
                        echo json_encode($res);
                    }
                    else{
                        $this->msgError();
                    }
                }
                else {
                    $this->msgError();
                }
        }

    }
    /**
     * thông báo lỗi
     */
    public function msgError() :void{
        $msgError = array(
            'status' => 'error',
            'msg' => 'Truy cập không hợp lệ',
        );
        echo json_encode($msgError);
    }
}
$getData = new getData();
if (isset($_GET['productID'])) {
    $productID = $_GET['productID'];
    $product = $getData->getData('productID', $productID);
    echo json_encode($product);
}
try{
    if (isset($_GET['fields'])) {
        $getData->fields($_GET['fields']);
        exit();
    } 
}catch(Exception $e){
    $getData->msgError();
}
?>