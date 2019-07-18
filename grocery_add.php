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
          <a class = "small" href="www.google.com">Forgot Password</a>  
           
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

// Generate query with user input
$stmt = "SELECT CASE WHEN $employeeID = EMP.ID and $emp_pass = PASS then 'TRUE' else 'FALSE' END validate FROM ( 
                   SELECT EMP.ID, PASS FROM GS_EMP emp inner join GS_EMP_PASS pass on emp.id = pass.id and upper(emp.name) = upper($emp_user)
      )";

// Get password verification
$result = $conn->query($stmt);

// New line
echo "<br>";                                                                                                                                                                                                                                

// start of sql injection blocker // Needed on a login page? XSS?
	if (substr_count($emp_user, "'") + substr_count($emp_pass, "'") > 0) {
    		 echo "<center>Please only enter characters.</center>";                                                                              
	} else {
    
        // Check if query result is valid
        // print mysqli_error($conn);
    
        // If TRUE then redirect to portal
        if ($result) {
            //header("Location: /var/www/html/portal.php")
            // How to restrict access to portal? 
            // How to store credentials throughout a users time on the site.
            echo "Welcome to the portal, $emp_user!
        } else {
            // If FALSE then display "Invalid user/pass combination, please try again."
            echo "Invalid user/pass combination, please try again."
        }
    }//end injection blocker

$conn->close();
?>



</head>



</html>

