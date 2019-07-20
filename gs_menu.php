<!DOCTYPE html>
<html>
<head>
<style>
	ul {
		list-style-type: none;
		margin: 0;
		padding: 0;
		overflow: hidden;
		background-color: #f3f3f3;
		position: fixed;
		top: 0;
		width: 100%;
	}
	li {
		float: left;
		border-right: 1px solid #bbb;
	}
	li:last_child {
		border-right: none;
	}
	li a {
		display: block;
		color: gray;
	 	text-align: center;
		padding: 14px 16px;
		text-decoration: none;
	}
	li a:hover {
		background-color: #111;
	}
	.active {
		background-color: #4CAF50;
	}
</style>

<ul>
	<li><a href = "/aws/gs_search.php">Product Search</a></li>
       <li> <a href = "/aws/gs_login.php">Employee Login</a></li>
      <!-- This page is a practice template for redirecting people who arent logged in-->
       <li> <a href = "/aws/gs_updates.php">Inventory Updates</a></li>
</ul>
</head>

</html>
