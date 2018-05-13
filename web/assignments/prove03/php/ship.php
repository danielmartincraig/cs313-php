<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 5/13/18
 * Time: 3:19 AM
 */

?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
<h1>Your Order Is Being Shipped to:</h1>
<table>
    <tr><td><?php echo htmlspecialchars($_POST['customerName'])?></td></tr>
    <tr><td><?php echo htmlspecialchars($_POST['streetAddress'])?></td></tr>
    <tr><td><?php echo htmlspecialchars($_POST['city'])?></td></tr>
    <tr><td><?php echo htmlspecialchars($_POST['state'])?></td></tr>
    <tr><td><?php echo htmlspecialchars($_POST['zip'])?></td></tr>
</table>
</body>
</html>
