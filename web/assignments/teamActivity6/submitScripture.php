<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 5/29/18
 * Time: 4:07 PM
 */

try
{
    $db = parse_url(getenv("DATABASE_URL"));
    $pdo = new PDO("pgsql:" . sprintf(
            "host=%s;port=%s;user=%s;password=%s;dbname=%s",
            $db["host"],
            $db["port"],
            $db["user"],
            $db["pass"],
            ltrim($db["path"], "/")
        ));
    // this line makes PDO give us an exception when there are problems, and can be very helpful in debugging!
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch (PDOException $ex)
{
    // If this were in production, you would not want to echo
    // the details of the exception.
    echo "Error connecting to DB. Details: $ex";
    die();
}

$book = $_POST['book'];
$chapter = $_POST['chapter'];
$verse = $_POST['verse'];
$content = $_POST['content'];
$topic_array = $_POST['formTopic'];

$topic_name_stmt = $pdo->prepare("SELECT name FROM topic");
$topic_name_stmt->execute();

$submit_scripture_stmt = $pdo->prepare("INSERT INTO scripture (book, chapter, verse, content) VALUES (:book, :chapter, :verse, :content);");
$submit_scripture_stmt->execute(array(':book' => $book, ':chapter' => $chapter, ':verse' => $verse, ':content' => $content));
$last_scripture_id = $pdo->lastInsertId('scripture_id_seq');

foreach ($topic_array as $topic) {
    $get_topic_id_stmt = $pdo->prepare("(SELECT id FROM topic WHERE name = :topic_name);");
    $get_topic_id_stmt->bindValue(':topic_name', $topic, PDO::PARAM_STR);
    $get_topic_id_stmt->execute();
    $topic_id = $get_topic_id_stmt->fetchall(PDO::FETCH_ASSOC)['id'];

    $submit_scripture_topic_stmt = $pdo->prepare("INSERT INTO scripture_topic (scripture_id, topic_id) VALUES (:scripture_id, :topic_id)");
    $topic_name_stmt->bindValue(':scripture_id', $last_scripture_id, PDO::PARAM_INT);
    $topic_name_stmt->bindValue(':topic_id', $topic_id, PDO::PARAM_INT);
    $topic_name_stmt->execute();
}


?>

