<?php $title = basename(__DIR__);
$_pathCss = '/css/cart.css';
require_once __DIR__ .'/../../inc/head.php' ;
require_once __DIR__ .'/cartController.php';
require_once __DIR__ .'/../../database/api/getData.php';
//show giỏ hàng trong biến session
if(!isset($_SESSION)) session_start();
if(isset($_SESSION['cart'])){
    $cart = $_SESSION['cart'];
}
?>
<section class="cart-order">
    <div class="container-cart">
        <div class="title"><h2>Giỏ hàng của bạn</h2></div>
        <div class="container-cart-items">
            <?php 
                $index = new cartController();
                foreach($cart as $key => $value){?>
                <div class="cart-item">
                    <div class="img-item">
                        <?php 
                            echo $index->index('img', $value['image'], $value['name']);
                         ?>
                    </div>
                    <div class="name-delete">
                        <div class="name-item">
                            <?php 
                                echo $index->index('nameProduct', $value['name']);
                             ?>
                        </div>
                        <div class="delete-item">
                            <?php
                                echo $index->index('deleteProduct', $key);
                             ?>
                        </div>
                    </div>
                    <div class="price-count">
                        <div class="price-item">
                            <?php
                                echo $index->index('price', $value['price'], 'price-product-' . $key, $value['quantity']);
                             ?>
                        </div>
                        <div class="count-item">
                            <div class="count">
                                <?php
                                    echo $index->index('decreaseValue', $key);
                                    echo $index->index('input', $key, $value['quantity']);
                                    echo $index->index('increaseValue', $key);
                                 ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php   
                }
             ?>
        </div>
        <div class="create-order">
            <div class="container-form">
                <form action="order.php" method="post">
                    <div class="info-order">
                        <div class="name-order">
                            <div class="label-info-order label-name">
                                <h5>Tên người nhận: </h5>
                            </div>
                            <div class="label-name-full">
                                <p><?php echo $_SESSION["name"] ?></p>
                            </div>
                        </div>
                        <div class="sdt-order">
                            <div class="label-info-order label-sdt">
                                <h5>Số điện thoại: </h5>
                            </div>
                            <div class="label-sdt-full">
                                <p><?php echo $_SESSION["phone"] ?></p>
                            </div>
                        </div>
                        <div class="address-order">
                            <div class="label-info-order label-address">
                                <h5>Địa chỉ nhận hàng: </h5>
                            </div>
                            <div class="label-address-full">
                                <p><?php echo $_SESSION["address"] ?></p>
                            </div>
                        </div>
                        <div class="select-branch">
                            <div class="label-branch">
                                <label for="branch">Chọn chi nhánh gần bạn nhất:</label>
                            </div>
                            <div class="label-branch-full">
                                <select name="branch" id="input-branch">
                                    <?php
                                        $index = new getData();
                                        $options = $index->getData('branch');
                                        foreach($options as $key => $value){
                                            echo '<option value="'.$value['id'].'">'.$value['address'].'</option>';
                                        }
                                     ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="info-price">
                        <div class="price-total">
                            <div class="label-price">
                                <h5>Tổng tiền: </h5>
                            </div>
                            <div class="label-price-full">
                                <p><?php
                                    $total = array_reduce($cart, function($carry, $item){
                                        return $carry + $item['price'] * $item['quantity'];
                                    }, 0);
                                    $_SESSION['totalPrice'] = $total;
                                    echo $total . 'đ';
                                 ?></p>
                            </div>
                        </div>
                        <div class="discount">
                            <div class="label-discount">
                                <h5>Giảm giá: </h5>
                            </div>
                            <div class="label-discount-full">
                                <p>0đ</p>
                            </div>
                        </div>
                        <div class="shipping">
                            <div class="label-shipping">
                                <h5>Phí vận chuyển: </h5>
                            </div>
                            <div class="label-shipping-full">
                                <p>0đ</p>
                            </div>
                        </div>
                    </div>
                    <div class="submit-order">
                        <button>Đặt hàng ngay</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php echo var_dump($_SESSION) ?>
