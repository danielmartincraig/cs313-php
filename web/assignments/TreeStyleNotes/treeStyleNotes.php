<?php
/**********************************************************
 * File: treeStyleNotes.php
 * Author: Daniel Craig
 *
 * Description: This represents the first version of my
 * TreeStyleNotes web app
 ***********************************************************/

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

function showChildren($pdo, $root)
{
    showChildrenWorker($pdo, $root, 0);
}

function showChildrenWorker($pdo, $root, $level) {
    $get_children_stmt = $pdo->prepare("SELECT note_id, category_id, parent_id, title, body, starred, color_string FROM notes AS n INNER JOIN colors AS c ON n.color_id = c.color_id WHERE parent_id = :parent_id AND NOT title = 'ROOT'");

    $get_children_stmt->execute(array(':parent_id' => $root));

    $notes = $get_children_stmt->fetchall(PDO::FETCH_ASSOC);

    foreach ($notes as $note) {
        //incorporate some concept of level here - the html will keep them in order
        $title = $note['title'];
        $body = $note['body'];
        $color = $note['color_string'];
        $starred = $note['starred'];

        echo "<div id=\"note_level_" . $level . "\" style=\"background-color:#" . $color . "\">";
        echo "<strong>$title</strong>";
        if ($starred) {
            echo "<img src='../../resources/star.png' id='star'>";
        }
        echo "<p>$body</p>";
        echo "</div>";

        showChildrenWorker($pdo, $note['note_id'], $level + 1);
    }
}

?>

<!doctype html>
<html>

<head>
    <link type="text/css" rel="stylesheet" href="main.css">
</head>

<body>
<div id="title"><h1>Tree Style Notes</h1></div>

<?php

showChildren($pdo, 1);

?>

<div>

</div>
</body>

</html>
