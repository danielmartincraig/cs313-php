<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 5/10/18
 * Time: 8:27 PM
 */

echo $_POST['addItemToCart'];

$cart[] = $_POST['addItemToCart'];
$_SESSION['cart'] = $cart;

echo $cart;

#echo '<script type="text/javascript">
#           window.location = "https://enigmatic-mountain-58448.herokuapp.com/assignments/prove03/storefront.php"
#     </script>';

?>