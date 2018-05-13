<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$temp = $_POST['removeButton'];
#print_r("temp = $temp");
$tempCart = $_SESSION['cart'];
#print_r($tempCart);
unset($tempCart[$temp]);
$_SESSION['cart'] = $tempCart;

echo '<script type="text/javascript">
           window.location = "viewCart.php"
      </script>';
?>