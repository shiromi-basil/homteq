<?php
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet

if (isset($_SESSION['userid'])) {
    $type;
    if ($_SESSION['userType'] == 'C') {
        $type = "Customer";
    } else if ($_SESSION['userType'] == 'A') {
        $type = "Adminstrator";
    }
    echo "<p id='loginName'>".$_SESSION['userFName']. " " .$_SESSION['userSName']." / " .$type. " No: " .$_SESSION['userid']. "</p>";
}
?>
