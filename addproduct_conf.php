<?php
include("db.php");

$pagename = "New Product Confirmation"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet

echo "<title>" . $pagename . "</title>"; //display name of the page as window title

echo "<body>";

include("headfile.html"); //include header layout file

include("detectlogin.php");

echo "<h4>" . $pagename . "</h4>"; //display name of the page on the web page

$pname = $_POST['pname'];
$spicname = $_POST["spicname"];
$lpicname = $_POST["lpicname"];
$shortdesc = $_POST["shortdesc"];
$longdesc = $_POST["longdesc"];
$price = $_POST["price"];
$stockquantity = $_POST["stockquantity"];

if (!(empty($pname) || empty($spicname) || empty($lpicname) || empty($shortdesc) || empty($longdesc) || empty($price) || empty($stockquantity))) {

    //create a $SQL variable and populate it with a SQL statement that saves product details
    $SQL = "insert into product (`prodName`,`prodPicNameSmall`, `prodPicNameLarge`,`prodDescripShort`,`prodDescripLong`,`prodPrice`,`prodQuantity`) values ('" . $pname . "','" . $spicname . "','" . $lpicname . "','" . $shortdesc . "','" . $longdesc . "'," . $price . "," . $stockquantity . ");";

    //run SQL query for connected DB or exit and display error message
    mysqli_query($conn, $SQL);

    if (mysqli_errno($conn) == 0) {
        echo "<p><b>The product has been added!</b></p>";
        echo "<p>Name of the product: " .$pname. "</p>";
        echo "<p>Name of the large picture:  " .$lpicname. "</p>";
        echo "<p>Name of the small picture:  " .$spicname. "</p>";
        echo "<p>Short Description: " .$shortdesc. "</p>";
        echo "<p>Long Description: " .$longdesc. "</p>";
        echo "<p>Price: &euro" .$price. "</p>";
        echo "<p>Initial Quantity: " .$stockquantity. "</p>";
        
    } else {
        echo "<b>The product was not added!</b>";
        if (mysqli_errno($conn) == 1062) {
            echo "<p>Product name is already in use.<br>";
            echo "Please try another product name.</p>";
            
        }

        if (mysqli_errno($conn) == 1064) {
            echo "<p>Illegal characters was entered in the form.<br>";
            echo "Make sure you avoid the following characters: apostrophes like ['] and backslashes like [\].</p>";
            
        }

        if (mysqli_errno($conn) == 1054) {
            echo "<p>Illegal characters was entered in the form.<br>";
            echo "Make sure you enter numerical value for price and initial stock quantity.<p>";
            
        }
        echo "Go back to <a href=addproduct.php>add product</a>.";
    }
} else {
    echo "<b>The product was not added!</b>";
    echo "<p>Your add product form is incomplete and all fields are mandatory.<br>";
    echo "Make sure provide all the required details.</p>";
    echo "Go back to <a href=addproduct.php>add product</a>.";
}

include("footfile.html"); //include foot layout

echo "</body>";
