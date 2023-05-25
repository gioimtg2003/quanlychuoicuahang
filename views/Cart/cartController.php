<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once __DIR__ . '/../../database/setup/connectDB.php';
require_once __DIR__ . '/../Menu/htmlElement.php';
class cartController extends ConnectDB
{
    private $name;
    private $price;
    private $image;
    private $id;
    private $quantity;
    public function __construct()
    {
        parent::__construct();
    }
    public function addCart()
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
            header('Content-Type: application/json');
            // gán giá trị cho các thuộc tính
            $this->id = $_POST['id'];
            $this->name = $_POST['name'];
            $this->price = $_POST['price'];
            $this->image = $_POST['image'];
            (int) $this->quantity = $_POST['quantity'];
            // tạo mảng chứa thông tin sản phẩm
            $cart = array(
                'name' => $this->name,
                'price' => $this->price,
                'image' => $this->image,
                'quantity' => (int) $this->quantity,
            );
            // kiểm tra xem có tồn tại sản phẩm trong session cart hay chưa
            // nếu tồn tại id trong session cart thì cộng dồn số lượng
            if (isset($_SESSION['cart'][$this->id]) && array_key_exists("quantity", $_SESSION['cart'][$this->id])) {
                $_SESSION['cart'][$this->id]['quantity'] += 1;

            } else {
                // nếu không tồn tại thì thêm mới sản phẩm vào session cart
                $_SESSION['cart'][$this->id] = $cart;
            }
        }
    }
    public function countCart()
    {
        
        $countCart = array();
        $countCart["countCart"] = count($_SESSION['cart']);
        echo json_encode($countCart);
    }
    public function index($htmlElement, ...$arg)
    {

        switch ($htmlElement) {
            // tạo thẻ img để hiện thị hình ảnh sản phẩm trong giỏ hàng
            case "img":
                $src = $arg[0];
                $alt = $arg[1];
                $Element = new html('img');
                $Element->src = $src;
                $Element->alt = $alt;
                return $Element->createHTML("", true);

            case "nameProduct":
                $name = $arg[0];
                return '<h3>' . $name . '</h3>';
            
            case "deleteProduct":
                $id = $arg[0];
                $Element = new html('a');
                $Element->onclick = "deleteProduct('" . $id . "')";
                $Element->class = "destroy";
                return $Element->createHTML("Xóa sản phẩm");
            
            case "price":
                $price = $arg[0];
                $Element = new html('span');
                $Element->id = $arg[1];
                return $Element->createHTML('Đơn giá: ' . $price * $arg[2] . 'đ');

            case "decreaseValue":
                $id = $arg[0];
                $innerHtml = '<i class="fa-solid fa-minus"></i>';
                $Element = new html('button');
                $Element->onclick = "decreaseValue('" . 'product-' .$id . "')";
                return $Element->createHTML($innerHtml);

            case "input":
                $id = $arg[0];
                $value = $arg[1];
                $Element = new html('input');
                $Element->type = 'text';
                $Element->value = $value;
                $Element->id = 'product-' .$id;
                return $Element->createHTML("", true);

            case "increaseValue":
                $id = $arg[0];
                $innerHtml = '<i class="fa-solid fa-plus"></i>';
                $Element = new html('button');
                $Element->onclick = "increaseValue('" . 'product-' .$id . "')";
                return $Element->createHTML($innerHtml);

            case "totalPrice":
                $totalPrice = $arg[0];
                $Element = new html('span');
                $Element->id = $arg[1];
                return $Element->createHTML('Tổng tiền: ' . $totalPrice . 'đ');
        }
    }
    public function updateQuantity(){
        if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])){
            $id = $_POST['id'];
            $quantity = $_POST['quantity'];
            $_SESSION['cart'][$id]['quantity'] = $quantity;
            $msg = array(
                'status' => 'success',
                'msg' => 'Cập nhật thành công'
            );
            echo json_encode($msg);
        }
    }
    public function deleteCart(){
        if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])){
            $id = $_POST['id'];
            unset($_SESSION['cart'][$id]);
            $msg = array(
                'status' => 'success',
                'msg' => 'Xóa thành công'
            );
            echo json_encode($msg);
        }
    }
    public function order(){
        if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST' ){
            $_SESSION['totalPrice'] = array_reduce($_SESSION['cart'], function($carry, $item){
                return $carry + $item['price'] * $item['quantity'];
            }, 0);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $timeCreate = date("Y-m-d H:i:s");
            $userId = (int)$_SESSION['id_account'];
            $totalPrice = $_SESSION['totalPrice'];
            $status = "shipping";
            (int)$branchId = $_POST['branch'];
            $address = $_SESSION['address'];
            $sql = "INSERT INTO oder(id, user_id, status, create_order, order_completion, price_total, id_branch, address) VALUES 
            (NULL, '$userId', '$status', '$timeCreate', NULL ,$totalPrice, $branchId, '$address')";
            $result = $this->connect();
            $result->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result->exec($sql);
            // lấy id của đơn hàng vừa tạo
            $idOrder = $result->lastInsertId();
            // thêm sản phẩm vào bảng order_detail
            foreach($_SESSION['cart'] as $key => $value){
                $productId = $key;
                $quantity = $value['quantity'];
                $sql = "INSERT INTO oder_item(`id`, `oder_id`, `product_id`, `quantity`) VALUES (NULL, $idOrder, $productId, $quantity)";
                $detail = $this->connect();
                $detail->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $detail->exec($sql);
            }

        }
    }
}

?>
