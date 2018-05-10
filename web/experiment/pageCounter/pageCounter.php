<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 5/10/18
 * Time: 4:00 PM
 */

session_start();



if (isset($_SESSION["visitCount"])) {
    $count = $_SESSION["visitCount"] + 1;
    $_SESSION["visitCount"] = $count;
} else {
    $_SESSION["visitCount"] = "1";
    $count = $_SESSION["visitCount"];
}

?>


<html>
<head>

</head>
<body>
<h1>
    <?php
    echo "You have visited $count time(s)";
    ?>
</h1>
</body>

</html>

