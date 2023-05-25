<?php
require_once __DIR__ . '/../../database/setup/connectDB.php';
class paging extends ConnectDB{
    private int $limit;
    public $pageCurrent;
    public function __construct()
    {
        parent::__construct();
        $this->limit = 10;
        $this->pageCurrent = isset($_GET['page']) ? $_GET['page'] : 1;
    }
    /**
     * lấy tổng số trang có thể hiện thị
     */
    public function get_TotalPage():int {
        $pdo = $this->connect();
        // lấy tổng số sản phẩm trong database chia cho số sản phẩm hiển thị trên 1 trang
        return ceil($pdo->query("SELECT COUNT(id) FROM product")->fetchColumn()/ $this->limit);
    }
    /**
     * lấy thông tin sản phẩm theo từng trang
     */
    public function getInfo()
    {
        // nếu trang hiện tại lớn hơn tổng số trang thì trang hiện tại = tổng số trang ngược lại nếu trang hiện tại nhỏ hơn 1 thì trang hiện tại = 1
        $this->pageCurrent = $this->pageCurrent > $this->get_TotalPage() ? $this->get_TotalPage() : ($this->pageCurrent < 1 ? 1 : $this->pageCurrent);

        $pdo = $this->connect();
        $start = ($this->pageCurrent - 1) * $this->limit;
        // $sql = "SELECT * FROM product LIMIT $start, $this->limit";
        $stmt = $pdo->prepare("SELECT * FROM product LIMIT $start, $this->limit");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
 ?>