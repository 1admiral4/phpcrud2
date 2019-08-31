<?php
// including the database connection file
include_once("config.php");

if(isset($_POST['update']))
{	
	$id = $_POST['id'];
	$productname=$_POST['Productname'];
	$price=$_POST['Price'];
	$stocks=$_POST['Stocks'];
	$category=$_POST['Category'];
	$supplier=$_POST['Supplier'];	
	
	// checking empty fields
	if(empty($productname) || empty($price) || empty($stocks) || empty($category) || empty($supplier)) {	
			
		if(empty($productname)) {
			echo "<font color='red'>Productname field is empty.</font><br/>";
		}
		
		if(empty($price)) {
			echo "<font color='red'>Price field is empty.</font><br/>";
		}
		
		if(empty($stocks)) {
			echo "<font color='red'>Stocks field is empty.</font><br/>";
		}
		if(empty($category)) {
			echo "<font color='red'>Category field is empty.</font><br/>";
		}
		if(empty($supplier)) {
			echo "<font color='red'>Supplier field is empty.</font><br/>";
		}		
	} else {	
		//updating the table
		$sql = "UPDATE tbl_products SET productname=:productname, price=:price, stocks=:stocks, category=:category, supplier=:supplier WHERE id=:id";
		$query = $dbConn->prepare($sql);

		$query->bindparam(':id', $id);
		$query->bindparam(':productname', $productname);
		$query->bindparam(':price', $price);
		$query->bindparam(':stocks', $stocks);
		$query->bindparam(':category', $category);
		$query->bindparam(':supplier', $supplier);
		$query->execute();
		
		// Alternative to above bindparam and execute
		// $query->execute(array(':id' => $id, ':name' => $name, ':email' => $email, ':age' => $age));
				
		//redirectig to the display page. In our case, it is index.php
		header("Location: index.php");
	}
}
?>

<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$sql = "SELECT * FROM tbl_products WHERE id=:id";
$query = $dbConn->prepare($sql);
$query->execute(array(':id' => $id));

while($row = $query->fetch(PDO::FETCH_ASSOC))
{
	$productname = $_POST['productname'];
	$price = $_POST['price'];
	$stocks = $_POST['stocks'];
	$category = $_POST['category'];
	$supplier = $_POST['supplier'];
}
?>
<html>
<head>	
	<title>Edit Data</title>
</head>

<body>
	<a href="index.php">Home</a>
	<br/><br/>
	
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>Productname</td>
				<td><input type="text" name="Productname" value="<?php echo $productname;?>"></td>
			</tr>
			<tr> 
				<td>Price</td>
				<td><input type="text" name="Price" value="<?php echo $price;?>"></td>
			</tr>
			<tr> 
				<td>Stocks</td>
				<td><input type="text" name="Stocks" value="<?php echo $stocks;?>"></td>
			</tr>
			<tr> 
				<td>Category</td>
				<td><input type="text" name="Category" value="<?php echo $category;?>"></td>
			</tr>
			<tr> 
				<td>Supplier</td>
				<td><input type="text" name="Supplier" value="<?php echo $supplier;?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value="<?php echo $_GET['id'];?>"></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>
