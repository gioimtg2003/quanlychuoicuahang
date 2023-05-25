<?php
require_once __DIR__ . '/cartController.php';
$order = new cartController();
$order->order();
$_SESSION["cart"] = []
 ?>