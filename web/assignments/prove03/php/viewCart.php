<?php
session_start();
$boots = $_SESSION['boots'];

$cart = $_SESSION['cart'];

?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>

<?php
include "header.php";
?>

<div>
    <table>
        <?php
        foreach ($cart as $cartElement) {
            echo "<form action='remove.php' method='post'>";
            echo "<tr><td>";
            echo "<p>" . $boots[$cartElement]['name'] . "</p>";
            echo "</td><td>";
            echo "<strong> " . $boots[$cartElement]['price'] . "</strong>";
            echo "</td><td>";
            echo "<input type='hidden' name='removeButton' value='$boots[$cartElement]['name']>";
            echo "<input type='submit' value='Remove from Cart'>";
            echo "</td></tr>";
            echo "</form>";
        }

        ?>
    </table>
</div>

<div>
<a href="storefront.php">Back to the Store</a>
</div>

<div>
<a href="checkout.php">Check Out</a>
</div>
</body>
</html>
