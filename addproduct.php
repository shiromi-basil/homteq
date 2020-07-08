<?php
$pagename="Add a New Product"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet

echo "<title>".$pagename."</title>"; //display name of the page as window title

echo "<body>";

include ("headfile.html"); //include header layout file

include("detectlogin.php");

echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

echo "<form action='addproduct_conf.php' method='post'>";
echo "<table style='border:0px'>";
echo "<tr><td class='signuptable'>";
echo "<label>*Product Name:</label><br></td>";
echo "<td class='signuptable'>";
echo "<input type='text' class='signupinput' name='pname'><br>";
echo "</td></tr>";

echo "<tr><td class='signuptable'>";
echo "<label>*Small Picture Name:</label><br></td>";
echo "<td class='signuptable'>";
echo "<input type='text' class='signupinput' name='spicname'><br>";
echo "</td></tr>";

echo "<tr><td class='signuptable'>";
echo "<label>*Large Picture Name:</label><br></td>";
echo "<td class='signuptable'>";
echo "<input type='text' class='signupinput' name='lpicname'><br>";
echo "</td></tr>";

echo "<tr><td class='signuptable'>";
echo "<label>*Short Description:</label><br></td>";
echo "<td class='signuptable'>";
echo "<input type='text' class='signupinput' name='shortdesc'><br>";
echo "</td></tr>";

echo "<tr><td class='signuptable'>";
echo "<label>*Long Description:</label><br></td>";
echo "<td class='signuptable'>";
echo "<input type='text' class='signupinput' name='longdesc'><br>";
echo "</td></tr>";

echo "<tr><td class='signuptable'>";
echo "<label>*Price:</label><br></td>";
echo "<td class='signuptable'>";
echo "<input type='text' class='signupinput' name='price'><br>";
echo "</td></tr>";

echo "<tr><td class='signuptable'>";
echo "<label>*Initial Stock Quantity:</label><br></td>";
echo "<td class='signuptable'>";
echo "<input type='text' class='signupinput' name='stockquantity'><br>";
echo "</td></tr>";

echo "<tr><td class='signuptable'>";
echo "<input type='submit' value='Add Product'>";
echo "<td class='signuptable'>";
echo "<input type='reset' value='Clear Form'>";
echo "</td></tr>";
echo "</table>";
echo "</form>";

include("footfile.html"); //include foot layout

echo "</body>";
?>