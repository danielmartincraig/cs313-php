<?php

require("getDb.php");
$pdo = getDbConnection();

$data = json_decode(file_get_contents('php://input'), true);

$note_id=$_POST['note_id'];
$title=$_POST['title'];
$body=$_POST['body'];
$category_id=$_POST['category_id'];

$update_note_stmt = $pdo->prepare("UPDATE notes SET title=:title, body=:body, category_id=:category_id WHERE note_id=:note_id;");

$update_note_stmt->execute(array(':title' => $title, ':body' => $body, ':category_id'=> $category_id, ':note_id' => $note_id));

?>
