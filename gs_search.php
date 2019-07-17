<!-- This page is for adding new items to the grocery table -->

<!Doctype html>
<html>

<head>
	<title> Inventory Check </title>

<center>
    <h2> Product Search </h2> 

	<form name="form" method="" Action ="">
       	  <input type="input" name ="searchfor"> </input>
      	  <input type="submit"></input>
	</form>

</center>

<?php
       if (file_exists("/var/www/sql_info.php")) {
        include "/var/www/sql_info.php";
}
?>

<?php
// Grab the text in the textbox
$productName = $_GET['searchfor'];

// Connect to mySQL
$conn = OpenCon();

// Generate query with user input
$stmt = "select * from grocery where product like '%$productName%'";

// Get all data from grocery table
$result = $conn->query($stmt);
// echo $stmt; // For testing sql statements

// Print error if any
//print mysqli_error($conn);

// New line
echo "<br>";                                                                                                                                                                                                                                

// start of sql injection blocker
	if (substr_count($productName, "'") > 0) {
    		 echo "<center>Please only enter characters.</center>";                                                                              
	} else {

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
	// When the requested product is not in the table
	 echo "<center>";
 	 echo "We do not carry ".$productName.".";
 	 echo "<br>";
 	 echo "Would you like us to stock up on ".$productName."?  ";
 	 echo "<br>";
  	 echo "<button type=\"button\"> Yes </button>  ";
 	 echo "<button type=\"button\"> No </button>";
 	 echo "</center>";
}
}//end injection blocker

$conn->close();
?>



</head>



</html>

