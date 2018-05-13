<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 5/10/18
 * Time: 8:27 PM
 */

session_start();

$cart = $_SESSION["cart"];
$itemToAdd = $_POST['addItemToCart'];
array_push($cart, $itemToAdd);

$_SESSION["cart"] = $cart;

#echo "<script type='text/javascript'>alert(count($cart);</script>";

echo '<script type="text/javascript">
           window.location = "https://enigmatic-mountain-58448.herokuapp.com/assignments/prove03/storefront.php"
     </script>';
?>