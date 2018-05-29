<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 5/29/18
 * Time: 3:48 PM
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

?>

<html>
<head>

</head>

<body>

<?php
$topic_name_stmt = $pdo->prepare("SELECT name FROM topic");
$topic_name_stmt->execute();

$topics = $topic_name_stmt->fetchall(PDO::FETCH_ASSOC);
?>

<form action="submitScripture.php">
    Book: <input type="text" name="Book"><br>
    Chapter: <input type="text" name="Chapter"><br>
    Verse: <input type="text" name="Verse"><br>
    Content: <textarea name="Content"></textarea><br>

    <?php

    foreach ($topics as $topic_row) {
        $topic = $topic_row['name'];

        echo "<input type=\"checkbox\">$topic";
        echo "<br>";
    }
    //echo "<input type=\"checkbox\"><input type='text'>";
    //echo "<br>";
    ?>

    <input type="submit" name="submit">

</form>

</body>
</html>
