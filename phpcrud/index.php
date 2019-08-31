<?php
//including the database connection file
include_once("config.php");


//fetching data in descending order (lastest entry first)
$result = $dbConn->query("SELECT * FROM tbl_products ORDER BY id DESC");
?>

<html>
<head>	
	<title>Homepage</title>
</head>

<body>
<a href="add.html">Add New Data</a><br/><br/>

	<table width='100%' border=0>

	<tr bgcolor='#CCCCCC'>
		<td>Productname</td>
		<td>Price</td>
		<td>Stocks</td>
		<td>Category</td>
		<td>Supplier</td>
	</tr>
	<?php 	
	while($row = $result->fetch(PDO::FETCH_ASSOC)) { 		
		echo "<tr>";
		echo "<td>".$row['productname']."</td>";
		echo "<td>".$row['price']."</td>";
		echo "<td>".$row['stocks']."</td>";
		echo "<td>".$row['category']."</td>";
		echo "<td>".$row['supplier']."</td>";
		echo "<td><a href=\"edit.php?id=$row[id]\">Edit</a> | <a href=\"delete.php?id=$row[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
	}
	?>
	</table>
</body>
</html>
