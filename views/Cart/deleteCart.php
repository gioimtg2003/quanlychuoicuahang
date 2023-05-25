<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once __DIR__ . '/cartController.php';
$deleteProduct = new cartController();
$deleteProduct->deleteCart();
 ?>