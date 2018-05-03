<header>
    <h1>Rexburg Iphone Repair</h1>
    <br>

    <?php
    $filename = basename($_SERVER['PHP_SELF']);

    if ($filename == 'about-us.php') {
        echo "<a href="home.php">About Us</a>";
        echo "<a href="about-us.php" id="highlight">About Us</a>";
        echo "<a href="login.php" >Login</a>";
    } elseif ($filename == 'home.php') {
        echo "<a href="home.php" id='highlight'>About Us</a>";
        echo "<a href="about-us.php" >About Us</a>";
        echo "<a href="login.php" >Login</a>";
    } elseif ($filename == 'login.php') {
        echo "<a href="home.php">About Us</a>";
        echo "<a href="about-us.php">About Us</a>";
        echo "<a href="login.php" id='highlight'>Login</a>";
    }
    ?>


</header>