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

$get_children_stmt = $pdo->prepare("SELECT category_id, color_id, parent_id, title, body, starred FROM notes WHERE parent_id = :parent_id AND NOT title = 'ROOT'");

?>

<!doctype html>
<html>

<head>
    <link type="text/css" rel="stylesheet" href="main.css">
</head>

<body>
<div id="title"><h1>Tree Style Notes</h1></div>

<?php

$get_children_stmt->execute(array(':parent_id' => 1));

$major_notes = $get_children_stmt->fetchall(PDO::FETCH_ASSOC);

foreach ($major_notes as $note) {
    $title = $note['title'];

    echo "<div id='note'>";
    echo "<p>$title</p>";
    echo "</div>";
}

?>

<div>

</div>
</body>

</html>
