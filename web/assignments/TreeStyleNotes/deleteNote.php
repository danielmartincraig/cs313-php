<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 6/3/18
 * Time: 1:27 AM
 */

require("getDb.php");
$pdo = getDbConnection();

$data = json_decode(file_get_contents('php://input'), true);

$note_id = $_POST['note_id'];

$delete_child_stmt = $pdo->prepare("DELETE FROM notes WHERE note_id = :note_id");

$delete_child_stmt->execute(array(':note_id' => $note_id));

?>
