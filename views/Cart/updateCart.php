<?php
require_once __DIR__ . '/cartController.php';
if (!isset($_SESSION)) {
    session_start();
}
$updateCart = new cartController();
$updateCart->updateQuantity();
 ?>