<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 5/10/18
 * Time: 8:25 PM
 */

session_start();

$item1 = array('brand' => 'Yeti', 'name' => 'Super Cooler', 'description' => 'Perfect for tubing down the river!', 'price' => '$300.00');
$item2 = array('brand' => 'Parker Brothers', 'name' => 'Monopoly', 'description' => 'Family Fun for Everyone!', 'price' => '$15.00');
$item3 = array('brand' => 'Meow Mix', 'name' => 'Cat Chow', 'description' => 'Keeps your kitty healthy!', 'price' => '$8.00');

$items = array($item1, $item2, $item3);

if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
} else {
    $cart = array();
    $_SESSION['cart'] = $cart;
}

?>


<html>
<head>

</head>
<body>
<h1>My Storefront</h1>

<div>
    <?php
    echo "You have " . count($cart) . " item(s) in your cart.";

    $mylist = array('daniel', 'levan', 'braxton');

    foreach ($mylist as $item) {
        echo "<p>$item</p>";
    }
    ?>
</div>

<form action="add.php" method="post">
    <?php
    foreach ($items as $item) {
        echo "<div>";
        echo "<h1>$item[brand] $item[name]</h1>";
        echo "<p>$item[description]</p>";
        echo "<strong>$item[price]</strong>";
        echo "<input type='hidden' name=$item[name]></hidden>";
        echo "<input type='submit' name='addItemToCart' value=$item>";
        echo "</div>";
    }
    ?>
</form>

</body>
</html>


