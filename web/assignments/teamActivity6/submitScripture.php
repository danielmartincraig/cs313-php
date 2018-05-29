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

$topic_name_stmt = $pdo->prepare("SELECT name FROM topic");
$topic_name_stmt->execute();

$topics = $topic_name_stmt->fetchall(PDO::FETCH_ASSOC);
print_r($topics);

$submit_scripture_stmt = $pdo->prepare("INSERT INTO scripture (book, chapter, verse, content) VALUES (:book, :chapter, :verse, :content);");
$submit_scripture_stmt->execute(array(":book" => $book, ":chapter" => $chapter, ":verse" => $verse, ":content" => $content));

?>

