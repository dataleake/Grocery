<!-- This page is for adding new items to the grocery table -->

<!Doctype html>
<html>

<head>
	<title> Inventory Check </title>
    
    <style>
        div.doubleb {
            border-style: double;
            width: 200px;
            height: 200px;
            background-color:lightblue;
	    text-align: center;
        }
    </style>
    
<center>
    <div class = doubleb>
    <h2> Product Search </h2> 

	<form name="form" method="" Action ="">
       	  <input type="input" name ="searchfor"> </input>
          <br><br>
      	  <input type="submit"></input>
	</form>
    </div>
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
echo "<br><center>";                                                                                                                                                                                                                                
echo "<div class = doubleb>";
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
  	 echo "<form method=\"post\"><input type=\"submit\" name=\"requesty\" id=\"requesty\" value=\"Yes\"/></form>";
         echo "<form method=\"post\"><input type=\"submit\" name=\"requestn\" id=\"requestn\" value=\"No\"/></form>";     
	 if (array_key_exists('requesty',$_POST)) {
                $result = $conn->query("insert into gs_rqt values ('pending', '$productName', null, null, null)");
		$err = $conn->error;
		printf($err);
		echo "Request submitted";
	}

	 if (array_key_exists('requestn',$_POST)) {print "Feel free to browse";}
         //if ($rqtSelection) { echo "Great, a request for $productName has been submitted."; } else {echo "OK, no problem";}
 	 //echo "<button type=\"button\"> Yes </button>";
	 //echo "<button type=\"button\"> No </button>";
 	 echo "</center>";
}
}//end injection blocker
echo "</center></div>";
$conn->close();
?>



</head>



</html>

