<?php
$pagename="Login"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet

echo "<title>".$pagename."</title>"; //display name of the page as window title

echo "<body>";

include ("headfile.html"); //include header layout file

echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

echo "<form action='login_process.php' method='post'>";
echo "<table style='border:0px'>";

echo "<tr><td class='signuptable'>";
echo "<label>*Email Address:</label><br></td>";
echo "<td class='signuptable'>";
echo "<input type='text' class='signupinput' name='email'><br>";
echo "</td></tr>";

echo "<tr><td class='signuptable'>";
echo "<label>*Password:</label><br></td>";
echo "<td class='signuptable'>";
echo "<input type='password' class='signupinput' name='password'><br>";
echo "</td></tr>";

echo "<tr><td class='signuptable'>";
echo "<input type='submit' value='Login'>";
echo "<td class='signuptable'>";
echo "<input type='reset' value='Clear Form'>";
echo "</td></tr>";
echo "</table>";
echo "</form>";

include("footfile.html"); //include foot layout

echo "</body>";
?>