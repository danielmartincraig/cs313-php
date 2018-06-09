<?php

require("getDb.php");
$pdo = getDbConnection();

$data = json_decode(file_get_contents('php://input'), true);

$note_id=$_POST['note_id'];
$title=$_POST['title'];
$body=$_POST['body'];
$color=$_POST['color'];
$starred=$_POST['starred'];

$update_note_stmt = $pdo->prepare("UPDATE notes SET title=:title, body=:body WHERE note_id=:note_id;");

$update_note_stmt->execute(array(':title' => $title, ':body' => $body, ':note_id' => $note_id));

?>
