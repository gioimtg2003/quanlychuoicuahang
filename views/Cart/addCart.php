<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once __DIR__ . '/cartController.php';

$addCart = new cartController();
$addCart->addCart();
echo json_encode($_SESSION['cart']);
exit();
