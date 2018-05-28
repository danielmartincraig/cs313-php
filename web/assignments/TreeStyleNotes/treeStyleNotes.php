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
    // Create the PDO connection
    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    // this line makes PDO give us an exception when there are problems, and can be very helpful in debugging!
    $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch (PDOException $ex)
{
    // If this were in production, you would not want to echo
    // the details of the exception.
    echo "Error connecting to DB. Details: $ex";
    die();
}

?>

p<!doctype html>
<html>

<head>
</head>

<body>
<div id="title"><h1>Tree Style Notes</h1></div>

<?php
$statement = $db->prepare("SELECT category_id, color_id, parent_id, title, body, starred FROM notes");
$statement->execute();

?>

<div>

</div>
</body>

</html>
