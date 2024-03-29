<?php 
// Query to return true if the password + ID are correct
// ..Practice encryption
query("SELECT CASE WHEN $managerID = EMP.ID and $managerPass = PASS then 'TRUE' else 'FALSE' END validate FROM ( 
       SELECT EMP.ID, PASS FROM GS_EMP emp inner join GS_EMP_PASS pass on emp.id = pass.id and upper(emp.name) = upper($name)
      )");
?>

<?php
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
