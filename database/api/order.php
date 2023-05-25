<?php
require_once __DIR__ . '/../../database/setup/connectDB.php';

class Order extends ConnectDB{
 
    public function __construct(){
        parent::__construct();

    }
    /**
     * Gửi thông tin đơn hàng vào bảng order
     */
    public function order($id_account, $id_product, $quantity): void
{
    $sql = 'INSERT INTO oder (user_id, product_id, quantity) VALUES (:id_account, :id_product, :quantity)';
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([
        ':id_account' => $id_account,
        ':id_product' => $id_product,
        ':quantity' => $quantity,
    ]);
}


    
}


 ?>