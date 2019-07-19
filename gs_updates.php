<!DOCTYPE html>
<html>

    <head>

    <title>Requests and updates</title>

    <center> <h2> Employee Portal </h2> </center>
    <?php echo "<h3>Welcome $user! </h3>"?>

    </head>

    <body>

<?php 
    if $numrequests > 2 {
        echo "<p>Please handle your requests for the day there are $numrequests pending.<p>";
    } else {
        echo "<p>You are up to date with your requests.<p>";
    }        
?>
<?php
// Connect to mySQL
$conn = OpenCon();

// Grab the text in the textbox
$statusFilter = $_GET['searchfor'];

// Get every item in the request table
$stmt = "select * from gs_rqt where status like '%$statusFilter%'";
$result = $conn->query($stmt);

// echo $stmt; // For testing sql statements

// Print error if any
// print mysqli_error($conn);

// New line
echo "<br>";      

//echo "<div class = doubleb>"; // to use for styling

// If there are results then print each value in a new cell	
if ($result->num_rows > 0 ) {
	echo "<center><table border = \"1\">";
	// Need column headers as variables
	echo "<th>Product</th>";
        echo "<th>Price</th>";
// Loop through results and store rows in table
    while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["product"]."</td>";
                echo "<td>".$row["price"]."</td>";
                echo "</tr>";
        }
	echo "</table></center>";
} else {
	// When there is no data in the request table
}

//echo "</div>"; // Needed for styling

// Queries for editing tables in the grocery + request table 

// Inserting new values into request table
query("INSERT INTO GS_RQT SET STATUS = \"pending\", PRODUCT = \"$productName\", PRICE = null, PRICE_RQT = \"$rqtProductPrice\", APPROVED = null"); 
// Drop approved column

// Showing manager what requests are in the table (Also add who approved to table?)
// Be able to filter down to pending, rejected, approved with radio buttons
query("SELECT * FROM GS_RQT WHERE STATUS = \"$statusChoice\"");

// If Approved
query("UPDATE GS_RQT SET STATUS = \"approved\")"; // Remove approved column
query("INSERT INTO GROCERY VALUES ($productName, $rqtProductPrice)"); //Trigger

// If Rejected
query("UPDATE GS_RQT SET STATUS = \"rejected\""); // Also notify user somehow
?>

    </body>


</html>