<?php
include("db.php");

$pagename = "View & Edit Product"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet

echo "<title>" . $pagename . "</title>"; //display name of the page as window title

echo "<body>";

include("headfile.html"); //include header layout file

include("detectlogin.php");

echo "<h4>" . $pagename . "</h4>"; //display name of the page on the web page

if (isset($_POST['hidden_editprodid'])) {
    $pridtobeupdated = $_POST['hidden_editprodid'];
    $newprice = $_POST['newprice'];
    $newqutoadd = $_POST['newprod_quantity'];
       
    $retieveSQL = "select prodQuantity from Product where prodId = " .$pridtobeupdated. ";";
    $exeSQL = mysqli_query($conn, $retieveSQL) or die(mysqli_error($conn));
    $arrayqu = mysqli_fetch_array($exeSQL);

    $newstock = $arrayqu['prodQuantity'] + $newqutoadd;
    if (!empty($_POST['newprice'])) {
        $updateSQL = "update Product SET prodQuantity = " . $newstock . ", prodPrice = " .$newprice. " where prodId = " . $pridtobeupdated . ";";
        $exeSQL = mysqli_query($conn, $updateSQL) or die(mysqli_error($conn));
    } else {
        $updateSQL = "update Product SET prodQuantity = " . $newstock . " where prodId = " . $pridtobeupdated . ";";
        $exeSQL = mysqli_query($conn, $updateSQL) or die(mysqli_error($conn));
    }
}

//create a $SQL variable and populate it with a SQL statement that retrieves product details
$SQL = "select prodId, prodName, prodPicNameSmall, prodDescripShort, prodPrice, prodQuantity from Product";
//run SQL query for connected DB or exit and display error message
$exeSQL = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
echo "<table style='border: 0px'>";
//create an array of records (2 dimensional variable) called $arrayp.
//populate it with the records retrieved by the SQL query previously executed.
//Iterate through the array i.e while the end of the array has not been reached, run through it
while ($arrayp = mysqli_fetch_array($exeSQL)) {
    echo "<tr>";
        echo "<td rowspan='5' style='border: 0px'>";
        //display the small image whose name is contained in the array
        echo "<img src=images/" . $arrayp['prodPicNameSmall'] . " height=250 width=250
        >";
        echo "</td>";
        echo "<td colspan='2' style='border: 0px; padding:5px 0px 0px 10px;'>";
        echo "<p><h5 >" . $arrayp['prodName'] . "</h5>"; //display product name as contained in the array
        echo "</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td colspan='2' style='border: 0px; padding:0px 0px 0px 10px'>";
        echo "<p>" . $arrayp['prodDescripShort']. "</td>";
    echo "</tr>";

    echo "<form action=editproduct.php method=post>";
    echo "<tr>";
        echo "<td style='border: 0px; padding:5px 0px 0px 10px;'>";
        echo "<p>Current Price: <b>&euro;" . $arrayp['prodPrice'] . "</b>";
        echo "</td>";
        echo "<td style='border: 0px'>";
        echo "<label>New Price: </label>";
        echo "<input type='text' name='newprice'><br>";
        echo "</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td style='border: 0px; padding:5px 0px 0px 10px;'>";
        echo "<p>Current Stock: <b>" . $arrayp['prodQuantity'] . "</b>";
        echo "</td>";
        echo "<td style='border: 0px'>";
        echo "<label>Add number of items: </label>";
        echo "<select name='newprod_quantity'>";
        for ($i = 0; $i <= 20; $i++) {
            echo "<option value='$i'> $i </option>";
        }
        echo "</select>";
    echo "</tr>";

    echo "<tr>";
        echo "<td style='border: 0px; padding:5px 0px 0px 10px;'>";
        echo "<p><input type=submit value='Update'><p>";
        echo "</td>";
    echo "</tr>";

    echo "<input type=hidden name='hidden_editprodid' value=" . $arrayp['prodId'] . ">";
    echo "</form>";

    echo "<tr>";
        echo "<td style='border: 0px; padding:5px 0px 0px 10px;'>";
        echo "</td>";
    echo "</tr>";
}
echo "</table>";

include("footfile.html"); //include foot layout

echo "</body>";
