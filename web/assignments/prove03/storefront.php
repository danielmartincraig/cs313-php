<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 5/10/18
 * Time: 8:25 PM
 */

$item1 = array('brand' => '', 'name' => '', 'description' => '', 'price' => '');
$item2 = array('brand' => '', 'name' => '', 'description' => '', 'price' => '');
$item3 = array('brand' => '', 'name' => '', 'description' => '', 'price' => '');

items = array($item1, $item2, $item3);

?>


<html>
<head>

</head>
<body>
<h1>My Storefront</h1>

<?php
for ($items as $key => $value) {
    echo $key . " " . $value;
}
?>

</body>
</html>


