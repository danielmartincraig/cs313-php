<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$temp = $_POST['myButton'];
$_SESSION['cart'][] = $temp;

echo '<script type="text/javascript">
           window.location = "storefront.php"
      </script>';
?>