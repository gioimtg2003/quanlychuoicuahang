<?php
session_start();
require_once __DIR__ . '/cartController.php';
$countCart = new cartController();
$countCart->countCart();
