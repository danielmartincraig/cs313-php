<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 6/3/18
 * Time: 1:03 AM
 */

require("getDb.php");
$pdo = getDbConnection();

$parent_id = $_POST['note_id'];

$create_child_stmt = $pdo->prepare("INSERT INTO notes(category_id, color_id, parent_id, title, body, starred) VALUES ((SELECT category_id FROM categories WHERE category_title = 'WEDDING'  AND category_description = 'Wedding Planning'), (SELECT color_id  FROM colors  WHERE color_name = 'GREEN'), :parent_id, 'New Note', '', TRUE)");

$create_child_stmt->execute(array(':parent_id' => $parent_id));

header("Location: treeStyleNotes.php");
die();

?>
