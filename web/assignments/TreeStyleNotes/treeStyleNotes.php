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

?>

<!doctype html>
<html>

<head>
</head>

<body>
<div id="title"><h1>Tree Style Notes</h1></div>

<?php
$statement = $pdo->prepare("SELECT category_id, color_id, parent_id, title, body, starred FROM notes WHERE NOT title = 'HIDDEN ROOT NODE'");
$statement->execute();
$rows = $statement->fetchall(PDO::FETCH_ASSOC);

foreach ($rows as $row) {
    $title = $row['title'];


    echo "<p>$title</p>";
}

?>

<div>

</div>
</body>

</html>
