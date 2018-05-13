<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 5/13/18
 * Time: 3:36 AM
 */

echo "<div><h1>Rocky Mountain Boot Suppliers</h1></div>";

echo "<div id='cartbutton'>";
echo "<a href='viewCart.php' id='cartlink'>Cart (" . count($_SESSION['cart']) . ")</a>";
echo "</div>";
?>
