<!-- This page is for adding new items to the grocery table -->
<!-- This page will ask for passwords and username when confirming changes -->

<!Doctype html>
<html>

<head>
       
	<title> Employee Portal </title>
    <style>
        div.double {
            border-style: double;
            width : 200px;
            height: 220px; <!--- Auto Adjust as variables? -->
        }
        a.small {
            font-size: 8pt;
        }
    </style>

<?php include "/var/www/html/aws/gs_menu.php"; ?>

<center>
    <div class = 'double'">

    <h2> Login </h2> 

	<form name="form" method="" Action ="">
       	  <center>
          <input type="input" name ="username" placeholder="username"> </input> </center>
          <br>
          <center><input type="password" name ="password" placeholder="password"> </input></center>
          <br>  
          <input type="submit"></input>
          <br><br>
          <a class = "small" href="/aws/gs_login.php">Forgot Password</a>  
           
	</form>
    </div>
</center>
<!--
<?php
       if (file_exists("/var/www/sql_info.php")) {
        include "/var/www/sql_info.php";
}
?>
-->
<?php
// Grab the text in the textbox
$emp_user = $_GET['username'];
$emp_pass = $_GET['password']; // Hash?

// Connect to mySQL
$conn = OpenCon();

$result = $conn->query($stmt);
print $conn->error;

// New line
echo "<br>";                  
                                                                                                                                                                                                              
// start of sql injection blocker // Needed on a login page? XSS?
	if (substr_count($emp_user, "'") + substr_count($emp_pass, "'") > 0) {
    		 echo "<center>Please only enter characters.</center>";                                                                              
	} else {
    
        // Check if query result is valid
        // print mysqli_error($conn);

// Connect to mySQL
$conn = OpenCon();                                                                                                                                                                                                                           

// Generate query with user input
$stmt = "SELECT '$emp_pass' = pass p FROM gs_emp emp inner join gs_emp_pass pass on emp.id = pass.id where upper(emp.name) = upper('$emp_user')";
// Will have to hash passwords, send them into table, pull password back into php then user password_verify(pass, hash)
// Get password verification                                                                                                                                                                                                                 $result = $conn->query($stmt);                                                                                                                                                                                                               print $conn->error;  
$result = $conn->query($stmt);
print $conn->error;
echo "<br>";
while($row = $result->fetch_assoc()) {
   
        if ($row["p"]) { // If the password is validated then...
            // How to restrict access to portal? 
            // How to store credentials throughout a users time on the site.
            echo "<center>Welcome to the portal, ".$emp_user."!</center>";
	    header("Location: gs_updates.php");
          } else {
            // If FALSE then display "Invalid user/pass combination, please try again."
            echo "<center><p style='color:red;'>Invalid user/pass combination, please try again.</center>";
          }
}	
    }//end injection blocker

$conn->close();
?>



</head>



</html>

