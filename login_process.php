<?php
include("db.php");

$pagename = "Your Login Results"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet

echo "<title>" . $pagename . "</title>"; //display name of the page as window title

echo "<body>";

include("headfile.html"); //include header layout file

echo "<h4>" . $pagename . "</h4>"; //display name of the page on the web page

$email = $_POST["email"];
$password = $_POST["password"];

if (!(empty($email) || empty($password))) {

    $expression = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
    $isemail = (preg_match($expression, $email)) ? true : false;

    if ($isemail) {

        //create a $SQL variable and populate it with a SQL statement
        $SQL = "select * from users where userEmail = '" . $email . "'";
        //run SQL query for connected DB or exit and display error message
        $exeSQL = mysqli_query($conn, $SQL);
        $arrayu = mysqli_fetch_array($exeSQL);

        if (!(isset($arrayu))) {
            echo "<b>Login failed!</b>";
            echo "<p>The email you entered was not recognized.<p>";
            echo "Go back to <a href=login.php>login</a>";
        } else {

            if (!($password == $arrayu['userPasscode'])) {
                echo "<b>Login failed!</b>";
                echo "<p>The password you entered is not valid.<p>";
                echo "Go back to <a href=login.php>login</a>";
            } else {
                $_SESSION['userid'] = $arrayu['userId'];
                $_SESSION['userType'] = $arrayu['userType'];
                $_SESSION['userFName'] = $arrayu['userFName'];
                $_SESSION['userSName'] = $arrayu['userSName'];

                $type;
                if ($_SESSION['userType'] == 'C') {
                    $type = "Customer";
                } else if ($_SESSION['userType'] == 'A') {
                    $type = "Adminstrator";
                }

                echo "<b>Login success!</b>";
                echo "<p>Hello, " .$_SESSION['userFName']. " " .$_SESSION['userSName']. "<p>";
                echo "<p>You have successfully logged in as a hometeq " .$type. " !<p>";
                echo "<p>Continue shopping for <a href=index.php>Home Tech</a></p>";
                echo "<p>View your <a href=basket.php>Smart Basket</a></p>";
            }
        }
    } else {
        echo "<b>Login failed!</b>";
        echo "<p>Email not valid.<br>";
        echo "Make sure you enter a correct email address.</p>";
        echo "Go back to <a href=login.php>login</a>";
    }
} else {
    echo "<b>Login failed!</b>";
    echo "<p>Your login form is incomplete.<br>";
    echo "Make sure you provide all the required details.</p>";
    echo "Go back to <a href=login.php>login</a>";
}

include("footfile.html"); //include foot layout

echo "</body>";
?>