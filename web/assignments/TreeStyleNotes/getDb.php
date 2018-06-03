<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 6/3/18
 * Time: 12:37 AM
 */

function getDbConnection ()
{
    try {
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
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $ex) {
        // If this were in production, you would not want to echo
        // the details of the exception.
        echo "Error connecting to DB. Details: $ex";
        die();
    }
    return $pdo;
}


?>
