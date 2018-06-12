<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 6/3/18
 * Time: 1:03 AM
 */

require("getDb.php");
$pdo = getDbConnection();

$data = json_decode(file_get_contents('php://input'), true);

$parent_note_id=$_POST['parent_note_id'];
$title=$_POST['title'];
$body=$_POST['body'];

$create_child_stmt = $pdo->prepare("INSERT INTO notes(category_id, color_id, parent_id, title, body, starred) VALUES ((SELECT category_id FROM categories WHERE category_title = 'WEDDING'  AND category_description = 'Wedding Planning'), (SELECT color_id  FROM colors  WHERE color_name = 'GREEN'), :parent_note_id, :title, :body, TRUE)");

$create_child_stmt->execute(array(':parent_note_id' => $parent_note_id, ':title' => $title, ':body' => $body));

?>
