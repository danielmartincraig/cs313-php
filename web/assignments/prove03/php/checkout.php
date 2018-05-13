<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 5/13/18
 * Time: 3:10 AM
 */

session_start();

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
    <h1>Checkout</h1>
</div>
<div>
    <form action="ship.php" method="post">
        <table>
            <tr>
                <td>
                    <input type="text" name="customerName"> Your Name
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="streetAddress"> Street Address
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="city"> City
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="state"> State
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="zip"> Zip Code
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Order!">
                </td>
            </tr>
        </table>
    </form>
    <div>
        <a href="viewCart.php">Back to Cart</a>
    </div>
</div>
</body>
</html>
