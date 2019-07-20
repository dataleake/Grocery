<!DOCTYPE html>
<html>

    <head>

    <title>Requests and updates</title>
<?php include "/var/www/html/aws/gs_menu.php"; ?>

    <center> <h2> Employee Portal </h2> </center>
    <?php print "<center><h3>Welcome $user! </h3></center>" ?>
    <!-- Select the current user from login db -->

<?php
       if (file_exists("/var/www/sql_info.php")) {
        include "/var/www/sql_info.php";

}

?>

    </head>

    <body>

<?php 
	
    // Connect to mySQL
    $conn = OpenCon();
    $stmt = "SELECT count(*) c FROM gs_rqt WHERE STATUS = 'pending'";
    $result = $conn->query($stmt);
   
if ($conn->error) {
	 print $conn->error;
	
} else {
	
	while($row = $result->fetch_assoc()) {
	
		$numPending = $row["c"];
	}
  	
	if($numPending > 0) {   
        		echo "<center><p>Please handle your requests for the day there are $numPending pending.</p></center>";
	} else {
		        echo "<center><p>You are up to date with your requests.</p></center>";
	}
} 
?>
<center>
<form name ='statusFilter' method="", action="">
        <input type="radio" name="status" value="" checked>See All
	<input type="radio" name="status" value="pending">Pending
	<input type="radio" name="status" value="approved">Approved  
	<input type="radio" name="status" value="rejected">Rejected
	<input type="submit">
</form>
</center>
<?php
// Grab the text in the textbox
$statusFilter = $_GET['status'];

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
	echo "<th>Status</th>";
        echo "<th>Product</th>";
	echo "<th>Price</th>";
	echo "<th>Requested Price</th>";
 	echo "<th>Approved</th>";
// Loop through results and store rows in table
    while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["status"]."</td>";
                echo "<td>".$row["product"]."</td>";
		echo "<td>".$row["price"]."</td>";
		echo "<td>".$row["price_rqt"]."</td>";
		echo "<td>".$row["approved"]."</td>";
                echo "</tr>";
        }
	echo "</table></center>";
} else {
	// When there is no data in the request table
}

//echo "</div>"; // Needed for styling

// Queries for editing tables in the grocery + request table 

// Inserting new values into request table
//query("INSERT INTO GS_RQT SET STATUS = \"pending\", PRODUCT = \"$productName\", PRICE = null, PRICE_RQT = \"$rqtProductPrice\", APPROVED = null"); 
// Drop approved column

// Showing manager what requests are in the table (Also add who approved to table?)
// Be able to filter down to pending, rejected, approved with radio buttons
//query("SELECT * FROM GS_RQT WHERE STATUS = \"$statusChoice\"");

// If Approved
//query("UPDATE GS_RQT SET STATUS = \"approved\")"; // Remove approved column
//query("INSERT INTO GROCERY VALUES ($productName, $rqtProductPrice)"); //Trigger

// If Rejected
//query("UPDATE GS_RQT SET STATUS = \"rejected\""); // Also notify user somehow
?>

    </body>


</html>
