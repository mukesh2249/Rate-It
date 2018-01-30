 <?php
	session_start();
	$category = $_GET['category'];
	$subCategory = $_GET['subCategory'];
	echo 'productListings.html?category='.$category.'&subCategory='.$subCategory;
	exit();	
?> 
