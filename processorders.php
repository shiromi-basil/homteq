<?php
include("db.php");

$pagename = "Process Orders"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet

echo "<title>" . $pagename . "</title>"; //display name of the page as window title

echo "<body>";

include("headfile.html"); //include header layout file

include("detectlogin.php");

echo "<h4>" . $pagename . "</h4>"; //display name of the page on the web page

$currentdatetime = date("Y-m-d H:i:s");
$currentUserId = $_SESSION['userid'];

if (!empty($_POST['hidden_orderno'])) {
    $updateNo = $_POST['hidden_orderno'];
    $updateStatus = $_POST['newOrderStatus'];

    if ($updateStatus == 'Collected') {
        $updateSQL = "update orders SET orderStatus = '" . $updateStatus . "', collectDateTime = '" .$currentdatetime. "' where orderNo = " . $updateNo . ";";
        $exeSQL = mysqli_query($conn, $updateSQL) or die(mysqli_error($conn));
    } else {
    $updateSQL = "update orders SET orderStatus = '" . $updateStatus . "' where orderNo = " . $updateNo . ";";
    $exeSQL = mysqli_query($conn, $updateSQL) or die(mysqli_error($conn));
    }
}

$SQL = "SELECT orders.orderNo, orders.orderDateTime, orders.collectDateTime, users.userId, users.userFName, users.userSName, orders.orderStatus, product.prodName, order_line.quantityOrdered 
        FROM product
        INNER JOIN order_line
        ON product.prodId = order_line.prodId
        INNER JOIN orders
        ON order_line.orderNo = orders.orderNo
        INNER JOIN users
        ON orders.userId = users.userId;";

$exeSQL = mysqli_query($conn, $SQL) or die(mysqli_error($conn));

$prevId = "";

echo "<table>";
while ($arrayp = mysqli_fetch_array($exeSQL)) {
    $currentId = $arrayp['orderNo'];
    if ($currentId != $prevId) {
        echo "<tr>";
        echo "<th>Order</th>";
        echo "<th>Order Date Time</th>";
        echo "<th>User Id</th>";
        echo "<th>Name</th>";
        echo "<th>Surname</th>";
        echo "<th>Status</th>";
        // echo "<th>Collect Date Time</th>";
        echo "<th>Product</th>";
        echo "<th>Quantity</th>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>" . $arrayp['orderNo'] . "</td>";
        echo "<td>" . $arrayp['orderDateTime'] . "</td>";
        echo "<td>" . $arrayp['userId'] . "</td>";
        echo "<td>" . $arrayp['userFName'] . "</td>";
        echo "<td>" . $arrayp['userSName'] . "</td>";

        if ($arrayp['orderStatus'] == 'Placed') {
            echo "<form action=processorders.php method=post>";
            echo "<td>";
            echo "<select name='newOrderStatus'>";
            echo "<option value='Placed'> Placed </option>";
            echo "<option value='Ready'> Ready to collect </option>";
            echo "<option value='Collected'> Collected </option>";
            echo "</select>";
            echo "<input type=submit value='Update'></td>";
            echo "<input type=hidden name='hidden_orderno' value=" . $arrayp['orderNo'] . ">";
            echo "</form>";
        } else if ($arrayp['orderStatus'] == 'Ready') {
            echo "<form action=processorders.php method=post>";
            echo "<td>";
            echo "<select name='newOrderStatus'>";
            echo "<option value='Ready'> Ready to collect </option>";
            echo "<option value='Collected'> Collected </option>";
            echo "</select>";
            echo "<input type=submit value='Update'></td>";
            echo "<input type=hidden name='hidden_orderno' value=" . $arrayp['orderNo'] . ">";
            echo "</form>";
        } else {
            echo "<td>" . $arrayp['orderStatus'] . "</td>";
        }

        // echo "<td>" . $arrayp['collectDateTime'] . "</td>";
        echo "<td>" . $arrayp['prodName'] . "</td>";
        echo "<td>" . $arrayp['quantityOrdered'] . "</td>";
        echo "</tr>";
    } else {
        // echo "<td colspan='7'></td>";
        echo "<td colspan='6'></td>";
        echo "<td>" . $arrayp['prodName'] . "</td>";
        echo "<td>" . $arrayp['quantityOrdered'] . "</td>";
    }
    $prevId = $currentId;
}
echo "</table>";

include("footfile.html"); //include foot layout

echo "</body>";
