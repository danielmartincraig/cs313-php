<?php

session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$_SESSION['boots'] = array('pecos' => array('name' => 'Pecos', 'price' => '$120.00'), 'langerter' => array('name' => 'Langerter', 'price' => '$160.00'), 'redmont' => array('name' => 'Redmont', 'price' => '$190.00'), 'legrande' => array('name' => 'LeGrande', 'price' => '$240.00'));
$boots = $_SESSION['boots'];

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
        <tr>
            <td>
                <?php echo "<p>" . $boots['pecos']['name'] . "</p>";?>
            </td>
            <td>
                <?php echo "<strong> " . $boots['pecos']['price'] . "</strong>"?>
            </td>
            <td>
                <form method="post" action="add.php">
                    <input type = hidden name='myButton' value='pecos'>
                    <input type='submit' value='Add to Cart'>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo "<p>" . $boots['langerter']['name'] . "</p>";?>
            </td>
            <td>
                <?php echo "<strong> " . $boots['langerter']['price'] . "</strong>"?>
            </td>
            <td>
                <form method="post" action="add.php">
                    <input type = hidden name='myButton' value='langerter'>
                    <input type='submit' value='Add to Cart'>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo "<p>" . $boots['redmont']['name'] . "</p>";?>
            </td>
            <td>
                <?php echo "<strong> " . $boots['redmont']['price'] . "</strong>"?>
            </td>
            <td>
                <form method="post" action="add.php">
                    <input type = hidden name='myButton' value='redmont'>
                    <input type='submit' value='Add to Cart'>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo "<p>" . $boots['legrande']['name'] . "</p>";?>
            </td>
            <td>
                <?php echo "<strong> " . $boots['legrande']['price'] . "</strong>"?>
            </td>
            <td>
                <form method="post" action="add.php">
                    <input type = hidden name='myButton' value='legrande'>
                    <input type='submit' value='Add to Cart'>
                </form>
            </td>
        </tr>
    </table>
</div>
</body>
</html>

