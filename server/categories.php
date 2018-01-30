 <?php
session_start();
//if (isset($_GET['getCategories']) && function_exists($_GET['getCategories'])){

// Create connection
$conn = mysqli_connect("localhost", "root", "root","productreview");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$purpose = $_POST["purpose"];

if($purpose == 'getcategories') {
	$query = "SELECT * from `category` where NULLIF(`category`.`deletedyn`,'') IS NULL";
	$result = mysqli_query($conn,$query);

	if ($result->num_rows > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$names[] = array(			
				'id' => $row['id'],
				'name' => $row['name'],
				'image' => $row['image']
			);
		}
		echo json_encode($names);
	}
	else{
		echo $purpose;
	}
}
else if ($purpose == 'getsubcategories') {
	$category = $_POST["category"];
	$query = "SELECT * from `subcategory` where `categoryid` = $category and NULLIF(`subcategory`.`deletedyn`,'') IS NULL";
	$result = mysqli_query($conn,$query);
	
	if ($result->num_rows > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$names[] = array(			
				'id' => $row['id'],
				'category_id' => $category,
				'name' => $row['name'],
				'image' => $row['image']
			);
		}
		echo json_encode($names);
	}
	else{
		echo "<b>Sub Category not found</b>";
	}
}
else if ($purpose == 'getproducts') {
	$category = $_POST["category"];	
	$subcategory = $_POST["subcategory"];
	$count = $_POST["count"];
	$count = $count * 8;	
	$query = "SELECT `products`.`pid` as 'productid',`product_name`,`products`.`brand`,`products`.`features`,`products`.`images`,`brandid`,`featureid`,`products`.`content`,`products`.`price` from (select `product`.`content`,`product`.`price`,`brand`.`id` as 'brandid',`features`.`id` as 'featureid',`product`.`id` as 'pid',`product`.`name` as 'product_name',`brand`.`name` as 'brand',GROUP_CONCAT(`features`.`name`) as 'features',`product`.`images` as 'images' from `product`,`category`,`subcategory`,`brand`,`features`, `product_features`where `product`.`id` = `product_features`.`productid` and `product`.`categoryid` = `category`.`id` and `product`.`subcategoryid` = `subcategory`.`id` and `product`.`brandid` = `brand`.`id` and `product_features`.`featureid` = `features`.`id` and `product`.`categoryid` = $category and `product`.`subcategoryid` = $subcategory and NULLIF(`product`.`deletedyn`,'') IS NULL group by `product`.`name`,`category`.`name`,`subcategory`.`name`,`brand`.`name`) products order by `products`.`pid` LIMIT $count, 8";

	$result = mysqli_query($conn,$query);
	
	if ($result->num_rows > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$names[] = array(
				'id' => $row['productid'],
				'name' => $row['product_name'],
				'images' => $row['images'],		
				'brand' => $row['brand'],
				'features' => $row['features'],
				'brandid' => $row['brandid'],
				'desc' => $row['content'],
				'price' => $row['price'],
				'featureid' => $row['featureid']
			);
		}
		echo json_encode($names);
	}
	else{
		echo "<b>Product not found</b>";
	}

}
else if ($purpose == 'searchproducts') {
	$search = $_POST["query"];
	$count = $_POST["count"];
	$count = $count * 8;
	$query = "SELECT `products`.`pid` as 'productid',`product_name`,`products`.`brand`,`products`.`features`,`products`.`images`,`brandid`,`featureid` ,`products`.`content`,`products`.`price` from (select `product`.`content`,`product`.`price`,`brand`.`id` as 'brandid',`features`.`id` as 'featureid',`product`.`id` as 'pid',`product`.`name` as 'product_name',`brand`.`name` as 'brand',GROUP_CONCAT(`features`.`name`) as 'features',`product`.`images` as 'images' from `product`,`category`,`subcategory`,`brand`,`features`, `product_features`where `product`.`id` = `product_features`.`productid` and `product`.`categoryid` = `category`.`id` and `product`.`subcategoryid` = `subcategory`.`id` and `product`.`brandid` = `brand`.`id` and `product_features`.`featureid` = `features`.`id` and lower(`product`.`name`) LIKE '%$search%' and NULLIF(`product`.`deletedyn`,'') IS NULL group by `product`.`name`,`category`.`name`,`subcategory`.`name`,`brand`.`name`) products order by `products`.`pid` LIMIT 0, 8";

	$result = mysqli_query($conn,$query);
	
	if ($result->num_rows > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$names[] = array(
				'id' => $row['productid'],
				'name' => $row['product_name'],
				'images' => $row['images'],		
				'brand' => $row['brand'],
				'features' => $row['features'],
				'brandid' => $row['brandid'],
					'desc' => $row['content'],
					'price' => $row['price'],
				'featureid' => $row['featureid']
			);
		}
		echo json_encode($names);
	}
	else{
		echo "<b>Product not found</b>";
	}

}
else if ($purpose == 'getbrands') {
	$category = $_POST["category"];	
	$subcategory = $_POST["subcategory"];
	$brand = $_POST["values"];
	$count = $_POST["count"];
	$features = $_POST["featurevalues"];
	$count = $count * 8;
	if($features != '' && $brand != ''){
		$query = "SELECT `products`.`pid` as 'productid',`product_name`,`products`.`brand`,`products`.`features`,`products`.`images`,`brandid`,`featureid` ,`products`.`content`,`products`.`price` from (select `product`.`content`,`product`.`price`, `brand`.`id` as 'brandid',`features`.`id` as 'featureid',`product`.`id` as 'pid',`product`.`name` as 'product_name',`brand`.`name` as 'brand',GROUP_CONCAT(`features`.`name`) as 'features',`product`.`images` as 'images' from `product`,`category`,`subcategory`,`brand`,`features`, `product_features`where `product`.`id` = `product_features`.`productid` and `product`.`categoryid` = `category`.`id` and `product`.`subcategoryid` = `subcategory`.`id` and `product`.`brandid` = `brand`.`id` and `product_features`.`featureid` = `features`.`id` and `product`.`categoryid` = $category and `product`.`subcategoryid` = $subcategory and `brand`.`name` in ($brand) and `features`.`name` in ($features) and NULLIF(`product`.`deletedyn`,'') IS NULL group by `product`.`name`,`category`.`name`,`subcategory`.`name`,`brand`.`name`) products order by `products`.`pid` LIMIT $count, 8";

		$result = mysqli_query($conn,$query);
		
		if ($result->num_rows > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$names[] = array(
					'id' => $row['productid'],
					'name' => $row['product_name'],
					'images' => $row['images'],	
					'brand' => $row['brand'],
					'desc' => $row['content'],
					'price' => $row['price'],
					'features' => $row['features']
				);
			}
			echo json_encode($names);
		}
		else{
			echo "<b>Brand not found</b>";
		}
	}
	else if($features != '' && $brand == ''){
		$query = "SELECT `products`.`pid` as 'productid',`product_name`,`products`.`brand`,`products`.`features`,`products`.`images`,`brandid`,`featureid` ,`products`.`content`,`products`.`price` from (select `product`.`content`,`product`.`price`,`brand`.`id` as 'brandid',`features`.`id` as 'featureid',`product`.`id` as 'pid',`product`.`name` as 'product_name',`brand`.`name` as 'brand',GROUP_CONCAT(`features`.`name`) as 'features',`product`.`images` as 'images' from `product`,`category`,`subcategory`,`brand`,`features`, `product_features`where `product`.`id` = `product_features`.`productid` and `product`.`categoryid` = `category`.`id` and `product`.`subcategoryid` = `subcategory`.`id` and `product`.`brandid` = `brand`.`id` and `product_features`.`featureid` = `features`.`id` and `product`.`categoryid` = $category and `product`.`subcategoryid` = $subcategory and `features`.`name` in ($features) and NULLIF(`product`.`deletedyn`,'') IS NULL group by `product`.`name`,`category`.`name`,`subcategory`.`name`,`brand`.`name`) products order by `products`.`pid` LIMIT $count, 8";

		$result = mysqli_query($conn,$query);
		
		if ($result->num_rows > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$names[] = array(
					'id' => $row['productid'],
					'name' => $row['product_name'],
					'images' => $row['images'],		
					'brand' => $row['brand'],
					'desc' => $row['content'],
					'price' => $row['price'],
					'features' => $row['features']
				);
			}
			echo json_encode($names);
		}
		else{
			echo "<b>Brand not found</b>";
		}
	}
	else {
		$query = "SELECT `products`.`pid` as 'productid',`product_name` as 'recentreview' ,`products`.`brand`,`products`.`features`,`products`.`images`,`brandid`,`featureid` ,`products`.`content`,`products`.`price` from (select `product`.`content`,`product`.`price`, `brand`.`id` as 'brandid',`features`.`id` as 'featureid',`product`.`id` as 'pid',`product`.`name` as 'product_name',`brand`.`name` as 'brand',GROUP_CONCAT(`features`.`name`) as 'features',`product`.`images` as 'images' from `product`,`category`,`subcategory`,`brand`,`features`, `product_features`where `product`.`id` = `product_features`.`productid` and `product`.`categoryid` = `category`.`id` and `product`.`subcategoryid` = `subcategory`.`id` and `product`.`brandid` = `brand`.`id` and `product_features`.`featureid` = `features`.`id` and `product`.`categoryid` = $category and `product`.`subcategoryid` = $subcategory and `brand`.`name` in ($brand) and NULLIF(`product`.`deletedyn`,'') IS NULL group by `product`.`name`,`category`.`name`,`subcategory`.`name`,`brand`.`name`) products order by `products`.`pid` LIMIT $count, 8";

		$result = mysqli_query($conn,$query);
		
		if ($result->num_rows > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$names[] = array(
					'id' => $row['productid'],
					'name' => $row['product_name'],
					'images' => $row['images'],		
					'brand' => $row['brand'],
					'desc' => $row['content'],
					'price' => $row['price'],
					'features' => $row['features']
				);
			}
			echo json_encode($names);
		}
		else{
			echo "<b>Brand not found</b>";
		}
	}
}
else if ($purpose == 'searchbrands') {
	$search = $_POST["query"];	
	$brand = $_POST["values"];
	$count = $_POST["count"];
	$features = $_POST["featurevalues"];
	$count = $count * 8;
	if($features != '' && $brand != ''){
		$query = "SELECT `products`.`pid` as 'productid',`product_name`,`products`.`brand`,`products`.`features`,`products`.`images`,`brandid`,`featureid` ,`products`.`content`,`products`.`price` from (select `product`.`content`,`product`.`price`, `brand`.`id` as 'brandid',`features`.`id` as 'featureid',`product`.`id` as 'pid',`product`.`name` as 'product_name',`brand`.`name` as 'brand',GROUP_CONCAT(`features`.`name`) as 'features',`product`.`images` as 'images' from `product`,`category`,`subcategory`,`brand`,`features`, `product_features`where `product`.`id` = `product_features`.`productid` and `product`.`categoryid` = `category`.`id` and `product`.`subcategoryid` = `subcategory`.`id` and `product`.`brandid` = `brand`.`id` and `product_features`.`featureid` = `features`.`id` and lower(`product`.`name`) LIKE '%$search%' and `brand`.`name` in ($brand) and `features`.`name` in ($features) and NULLIF(`product`.`deletedyn`,'') IS NULL group by `product`.`name`,`category`.`name`,`subcategory`.`name`,`brand`.`name`) products order by `products`.`pid` LIMIT $count, 8";

		$result = mysqli_query($conn,$query);
	
		if ($result->num_rows > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$names[] = array(
					'id' => $row['productid'],
					'name' => $row['product_name'],
					'images' => $row['images'],		
					'brand' => $row['brand'],
					'desc' => $row['content'],
					'price' => $row['price'],
					'features' => $row['features']
				);
			}
			echo json_encode($names);
		}
		else{
			echo "<b>Brand not found</b>";
		}
	}
	else if($features != '' && $brand == ''){
		$query = "SELECT `products`.`pid` as 'productid',`product_name`,`products`.`brand`,`products`.`features`,`products`.`images`,`brandid`,`featureid` ,`products`.`content`,`products`.`price` from (select `product`.`content`,`product`.`price`,`brand`.`id` as 'brandid',`features`.`id` as 'featureid',`product`.`id` as 'pid',`product`.`name` as 'product_name',`brand`.`name` as 'brand',GROUP_CONCAT(`features`.`name`) as 'features',`product`.`images` as 'images' from `product`,`category`,`subcategory`,`brand`,`features`, `product_features`where `product`.`id` = `product_features`.`productid` and `product`.`categoryid` = `category`.`id` and `product`.`subcategoryid` = `subcategory`.`id` and `product`.`brandid` = `brand`.`id` and `product_features`.`featureid` = `features`.`id` and lower(`product`.`name`) LIKE '%$search%' and `features`.`name` in ($features) and NULLIF(`product`.`deletedyn`,'') IS NULL group by `product`.`name`,`category`.`name`,`subcategory`.`name`,`brand`.`name`) products order by `products`.`pid` LIMIT $count, 8";

		$result = mysqli_query($conn,$query);
	
		if ($result->num_rows > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$names[] = array(
					'id' => $row['productid'],
					'name' => $row['product_name'],
					'images' => $row['images'],		
					'brand' => $row['brand'],
					'desc' => $row['content'],
					'price' => $row['price'],
					'features' => $row['features']
				);
			}
			echo json_encode($names);
		}
		else{
			echo "<b>Brand not found</b>";
		}
	}
	else {
		$query = "SELECT `products`.`pid` as 'productid',`product_name`,`products`.`brand`,`products`.`features`,`products`.`images`,`brandid`,`featureid` ,`products`.`content`,`products`.`price` from (select `product`.`content`,`product`.`price`, `brand`.`id` as 'brandid',`features`.`id` as 'featureid',`product`.`id` as 'pid',`product`.`name` as 'product_name',`brand`.`name` as 'brand',GROUP_CONCAT(`features`.`name`) as 'features',`product`.`images` as 'images' from `product`,`category`,`subcategory`,`brand`,`features`, `product_features`where `product`.`id` = `product_features`.`productid` and `product`.`categoryid` = `category`.`id` and `product`.`subcategoryid` = `subcategory`.`id` and `product`.`brandid` = `brand`.`id` and `product_features`.`featureid` = `features`.`id` and lower(`product`.`name`) LIKE '%$search%' and `brand`.`name` in ($brand) and NULLIF(`product`.`deletedyn`,'') IS NULL group by `product`.`name`,`category`.`name`,`subcategory`.`name`,`brand`.`name`) products order by `products`.`pid` LIMIT $count, 8";

		$result = mysqli_query($conn,$query);
	
		if ($result->num_rows > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$names[] = array(
					'id' => $row['productid'],
					'name' => $row['product_name'],
					'images' => $row['images'],		
					'brand' => $row['brand'],
					'desc' => $row['content'],
					'price' => $row['price'],
					'features' => $row['features']
				);
			}
			echo json_encode($names);
		}
		else{
			echo "<b>Brand not found</b>";
		}
	}

}
else if ($purpose == 'getfeatures') {
	$category = $_POST["category"];	
	$subcategory = $_POST["subcategory"];
	$features = $_POST["values"];
	$brands = $_POST["brandvalues"];
	$count = $_POST["count"];
	$count = $count * 8;
	if($brands != '' && $features != ''){
		$query = "SELECT `products`.`pid` as 'productid',`product_name`,`products`.`brand`,`products`.`features`,`products`.`images`,`brandid`,`featureid` ,`products`.`content`,`products`.`price` from (select `product`.`content`,`product`.`price`,`brand`.`id` as 'brandid',`features`.`id` as 'featureid',`product`.`id` as 'pid',`product`.`name` as 'product_name',`brand`.`name` as 'brand',GROUP_CONCAT(`features`.`name`) as 'features',`product`.`images` as 'images' from `product`,`category`,`subcategory`,`brand`,`features`, `product_features`where `product`.`id` = `product_features`.`productid` and `product`.`categoryid` = `category`.`id` and `product`.`subcategoryid` = `subcategory`.`id` and `product`.`brandid` = `brand`.`id` and `product_features`.`featureid` = `features`.`id` and `product`.`categoryid` = $category and `product`.`subcategoryid` = $subcategory and `features`.`name` in ($features) and `brand`.`name` in ($brands) and NULLIF(`product`.`deletedyn`,'') IS NULL group by `product`.`name`,`category`.`name`,`subcategory`.`name`,`brand`.`name`) products order by `products`.`pid` LIMIT $count, 8";

		$result = mysqli_query($conn,$query);
	
		if ($result->num_rows > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$names[] = array(
					'id' => $row['productid'],
					'name' => $row['product_name'],
					'images' => $row['images'],		
					'brand' => $row['brand'],
					'desc' => $row['content'],
					'price' => $row['price'],
					'features' => $row['features']
				);
			}
			echo json_encode($names);
		}
		else{
			echo "<b>Feature not found</b>";
		}
	}
	else if($brands != '' && $features == ''){
		$query = "SELECT `products`.`pid` as 'productid',`product_name`,`products`.`brand`,`products`.`features`,`products`.`images`,`brandid`,`featureid` ,`products`.`content`,`products`.`price` from (select `product`.`content`,`product`.`price`,`brand`.`id` as 'brandid',`features`.`id` as 'featureid',`product`.`id` as 'pid',`product`.`name` as 'product_name',`brand`.`name` as 'brand',GROUP_CONCAT(`features`.`name`) as 'features',`product`.`images` as 'images' from `product`,`category`,`subcategory`,`brand`,`features`, `product_features`where `product`.`id` = `product_features`.`productid` and `product`.`categoryid` = `category`.`id` and `product`.`subcategoryid` = `subcategory`.`id` and `product`.`brandid` = `brand`.`id` and `product_features`.`featureid` = `features`.`id` and `product`.`categoryid` = $category and `product`.`subcategoryid` = $subcategory and `brand`.`name` in ($brands) and NULLIF(`product`.`deletedyn`,'') IS NULL group by `product`.`name`,`category`.`name`,`subcategory`.`name`,`brand`.`name`) products order by `products`.`pid` LIMIT $count, 8";

		$result = mysqli_query($conn,$query);
	
		if ($result->num_rows > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$names[] = array(
					'id' => $row['productid'],
					'name' => $row['product_name'],
					'images' => $row['images'],		
					'brand' => $row['brand'],
					'desc' => $row['content'],
					'price' => $row['price'],
					'features' => $row['features']
				);
			}
			echo json_encode($names);
		}
		else{
			echo "<b>Feature not found</b>";
		}
	}
	else {
		$query = "SELECT `products`.`pid` as 'productid',`product_name`,`products`.`brand`,`products`.`features`,`products`.`images`,`brandid`,`featureid` ,`products`.`content`,`products`.`price` from (select `product`.`content`,`product`.`price`, `brand`.`id` as 'brandid',`features`.`id` as 'featureid',`product`.`id` as 'pid',`product`.`name` as 'product_name',`brand`.`name` as 'brand',GROUP_CONCAT(`features`.`name`) as 'features',`product`.`images` as 'images' from `product`,`category`,`subcategory`,`brand`,`features`, `product_features`where `product`.`id` = `product_features`.`productid` and `product`.`categoryid` = `category`.`id` and `product`.`subcategoryid` = `subcategory`.`id` and `product`.`brandid` = `brand`.`id` and `product_features`.`featureid` = `features`.`id` and `product`.`categoryid` = $category and `product`.`subcategoryid` = $subcategory and `features`.`name` in ($features) and NULLIF(`product`.`deletedyn`,'') IS NULL group by `product`.`name`,`category`.`name`,`subcategory`.`name`,`brand`.`name`) products order by `products`.`pid` LIMIT $count, 8";

		$result = mysqli_query($conn,$query);
	
		if ($result->num_rows > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$names[] = array(
					'id' => $row['productid'],
					'name' => $row['product_name'],
					'images' => $row['images'],		
					'brand' => $row['brand'],
					'desc' => $row['content'],
					'price' => $row['price'],
					'features' => $row['features']
				);
			}
			echo json_encode($names);
		}
		else{
			echo "<b>Feature not found</b>";
		}
	}

}
else if ($purpose == 'searchfeatures') {	
	$search = $_POST["query"];
	$features = $_POST["values"];
	$brands = $_POST["brandvalues"];
	if($brands != '' && $features != ''){
		$count = $_POST["count"];
		$count = $count * 8;
		$query = "SELECT `products`.`pid` as 'productid',`product_name`,`products`.`brand`,`products`.`features`,`products`.`images`,`brandid`,`featureid` ,`products`.`content`,`products`.`price` from (select `product`.`content`,`product`.`price`,`brand`.`id` as 'brandid',`features`.`id` as 'featureid',`product`.`id` as 'pid',`product`.`name` as 'product_name',`brand`.`name` as 'brand',GROUP_CONCAT(`features`.`name`) as 'features',`product`.`images` as 'images' from `product`,`category`,`subcategory`,`brand`,`features`, `product_features`where `product`.`id` = `product_features`.`productid` and `product`.`categoryid` = `category`.`id` and `product`.`subcategoryid` = `subcategory`.`id` and `product`.`brandid` = `brand`.`id` and `product_features`.`featureid` = `features`.`id` and lower(`product`.`name`) LIKE '%$search%' and `features`.`name` in ($features) and  `brand`.`name` in ($brands) and NULLIF(`product`.`deletedyn`,'') IS NULL group by `product`.`name`,`category`.`name`,`subcategory`.`name`,`brand`.`name`) products order by `products`.`pid` LIMIT $count, 8";

		$result = mysqli_query($conn,$query);
		
		if ($result->num_rows > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$names[] = array(
					'id' => $row['productid'],
					'name' => $row['product_name'],
					'images' => $row['images'],		
					'brand' => $row['brand'],
					'desc' => $row['content'],
					'price' => $row['price'],
					'features' => $row['features']
				);
			}
			echo json_encode($names);
		}
		else{
			echo "<b>Feature not found</b>";
		}
	}
	else if($brands != '' && $features == ''){
		$count = $_POST["count"];
		$count = $count * 8;
		$query = "SELECT `products`.`pid` as 'productid',`product_name`,`products`.`brand`,`products`.`features`,`products`.`images`,`brandid`,`featureid` ,`products`.`content`,`products`.`price` from (select `product`.`content`,`product`.`price`,`brand`.`id` as 'brandid',`features`.`id` as 'featureid',`product`.`id` as 'pid',`product`.`name` as 'product_name',`brand`.`name` as 'brand',GROUP_CONCAT(`features`.`name`) as 'features',`product`.`images` as 'images' from `product`,`category`,`subcategory`,`brand`,`features`, `product_features`where `product`.`id` = `product_features`.`productid` and `product`.`categoryid` = `category`.`id` and `product`.`subcategoryid` = `subcategory`.`id` and `product`.`brandid` = `brand`.`id` and `product_features`.`featureid` = `features`.`id` and lower(`product`.`name`) LIKE '%$search%' and `brand`.`name` in ($brands) and NULLIF(`product`.`deletedyn`,'') IS NULL group by `product`.`name`,`category`.`name`,`subcategory`.`name`,`brand`.`name`) products order by `products`.`pid` LIMIT $count, 8";

		$result = mysqli_query($conn,$query);
		
		if ($result->num_rows > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$names[] = array(
					'id' => $row['productid'],
					'name' => $row['product_name'],
					'images' => $row['images'],		
					'brand' => $row['brand'],
					'desc' => $row['content'],
					'price' => $row['price'],
					'features' => $row['features']
				);
			}
			echo json_encode($names);
		}
		else{
			echo "<b>Feature not found</b>";
		}
	}
	else {
		$count = $_POST["count"];
		$count = $count * 8;
		$query = "SELECT `products`.`pid` as 'productid',`product_name`,`products`.`brand`,`products`.`features`,`products`.`images`,`brandid`,`featureid` ,`products`.`content`,`products`.`price` from (select `product`.`content`,`product`.`price`, `brand`.`id` as 'brandid',`features`.`id` as 'featureid',`product`.`id` as 'pid',`product`.`name` as 'product_name',`brand`.`name` as 'brand',GROUP_CONCAT(`features`.`name`) as 'features',`product`.`images` as 'images' from `product`,`category`,`subcategory`,`brand`,`features`, `product_features`where `product`.`id` = `product_features`.`productid` and `product`.`categoryid` = `category`.`id` and `product`.`subcategoryid` = `subcategory`.`id` and `product`.`brandid` = `brand`.`id` and `product_features`.`featureid` = `features`.`id` and lower(`product`.`name`) LIKE '%$search%' and `features`.`name` in ($features) and NULLIF(`product`.`deletedyn`,'') IS NULL group by `product`.`name`,`category`.`name`,`subcategory`.`name`,`brand`.`name`) products order by `products`.`pid` LIMIT $count, 8";

		$result = mysqli_query($conn,$query);
		
		if ($result->num_rows > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$names[] = array(
					'id' => $row['productid'],
					'name' => $row['product_name'],
					'images' => $row['images'],		
					'brand' => $row['brand'],
					'desc' => $row['content'],
					'price' => $row['price'],
					'features' => $row['features']
				);
			}
			echo json_encode($names);
		}
		else{
			echo "<b>Feature not found</b>";
		}
	}

}
else if ($purpose == 'getproduct') {
	$category = $_POST["category"];	
	$subcategory = $_POST["subcategory"];
	$productid = $_POST["product"];
	$username = $_POST["username"];

	$checkquery = "select `review`.`id` from `review`,`users`,`product` where NULLIF(`review`.`deletedyn`,'') IS NULL and `product`.`id` = `review`.`productid` and `review`.`productid` = $productid and NULLIF(`product`.`deletedyn`,'') IS NULL";
	$checkresult = mysqli_query($conn,$checkquery);
	if ($checkresult->num_rows > 0) {
		while($row = mysqli_fetch_assoc($checkresult)) {
			$checkuser[] = array(
				'id' => $row['id']
			);
		}
	}
	
	if(count($checkuser) > 0){
		$query = "select `review`.`id`,`users`.`username`,`review`.`rating`,`review`.`feedback`,`review`.`datereviewed` from `review`,`users`,`product` where `users`.`id` = `review`.`userid` and NULLIF(`review`.`deletedyn`,'') IS NULL and `product`.`id` = `review`.`productid` and `review`.`productid` = $productid and NULLIF(`product`.`deletedyn`,'') IS NULL and `users`.`username` = '$username' order by `review`.`datereviewed` desc";

		$result = mysqli_query($conn,$query);
		
		if ($result->num_rows > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$currentuser[] = array(
					'id' => $row['id'],
					'username' => $row['username'],
					'review' => $row['feedback'],
					'rating' => $row['rating'],
					'date' => $row['datereviewed']
				);
			}
		}

		$query = "select `review`.`id`,`users`.`username`,`review`.`rating`,`review`.`feedback`,`review`.`datereviewed` from `review`,`users`,`product` where `users`.`id` = `review`.`userid` and NULLIF(`review`.`deletedyn`,'') IS NULL and `product`.`id` = `review`.`productid` and `review`.`productid` = $productid and NULLIF(`product`.`deletedyn`,'') IS NULL and `users`.`username` != '$username' order by `review`.`datereviewed` desc";

		$result = mysqli_query($conn,$query);
	
		if ($result->num_rows > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$names[] = array(
					'id' => $row['id'],
					'username' => $row['username'],
					'review' => $row['feedback'],
					'rating' => $row['rating'],
					'date' => $row['datereviewed']
				);
			}

			if(count($currentuser) > 0){
				$resultant = array_merge($currentuser,$names);
			}
			else if(count($names) < 0 && count($currentuser) > 0) {
				$resultant = $currentuser;
			}
			else {
				$resultant = $names;
			}

			$productquery = "select `product`.`id`,`product`.`name`,`product`.`content`,`product`.`images`,`product`.`price`,`brand`.`name` as 'brand', GROUP_CONCAT(`features`.`name`) as 'features',CAST(avg(`review`.`rating`) AS DECIMAL(10,1)) as 'average',`review2`.`total` as 'total' from `product`,`brand`,`features`, `product_features`,`review`,(select count(*) as 'total' from  `product`,`review` where `product`.`id` = `review`.`productid` and `product`.`id` = $productid and NULLIF(`review`.`deletedyn`,'') IS NULL) `review2` where `product`.`id` = `product_features`.`productid` and`product`.`brandid` = `brand`.`id` and `product_features`.`featureid` = `features`.`id` and NULLIF(`product`.`deletedyn`,'') IS NULL and `product`.`id` = $productid and `product`.`id` = `review`.`productid` group by `product`.`id`,`product`.`name`,`brand`.`name`";

			$productresult = mysqli_query($conn,$productquery);
			if ($productresult->num_rows > 0) {
				while($row = mysqli_fetch_assoc($productresult)) {
					$product[] = array(	
						'id' => $row['id'],				
						'name' => $row['name'],
						'images' => $row['images'],
						'average' => $row['average'],
						'total' => $row['total'],
						'description' => $row['content'],
						'price' => $row['price'],
						'brand' => $row['brand'],
						'features' => $row['features'],
						'reviews' => $resultant
					);
				}
			}

			echo json_encode($product);
		}
		else{
			echo "<b>Product not found</b>";
		}
	}
	else {
		$productquery = "select `product`.`id`,`product`.`name`,`product`.`content`,`product`.`images`,`product`.`price`,`brand`.`name` as 'brand', GROUP_CONCAT(`features`.`name`) as 'features' from `product`,`brand`,`features`, `product_features`where `product`.`id` = `product_features`.`productid` and`product`.`brandid` = `brand`.`id` and `product_features`.`featureid` = `features`.`id` and NULLIF(`product`.`deletedyn`,'') IS NULL and `product`.`id` = $productid group by `product`.`id`,`product`.`name`,`brand`.`name`";

			$productresult = mysqli_query($conn,$productquery);
			if ($productresult->num_rows > 0) {
				while($row = mysqli_fetch_assoc($productresult)) {
					$product[] = array(	
						'id' => $row['id'],				
						'name' => $row['name'],
						'images' => $row['images'],
						'average' => 0,
						'total' => 0,
						'description' => $row['content'],
						'price' => $row['price'],
						'brand' => $row['brand'],
						'features' => $row['features']
					);
				}
			}

			echo json_encode($product);

	}

}

else if ($purpose == 'addwishlist') {
	$productid = $_POST["productid"];
	$username = $_POST["username"];
	
	$query = "select * from `users`,`wishlist`,`product` where `users`.`username` = '$username' and `wishlist`.`userid` = `users`.`id` and NULLIF(`wishlist`.`deletedyn`,'') IS NULL and `product`.`id` = `wishlist`.`productid` and `wishlist`.`productid` = $productid and NULLIF(`product`.`deletedyn`,'') IS NULL";
	$result = mysqli_query($conn,$query); 
	if ($result->num_rows > 0) {
		$final = 0;
    }
	else {
		$query = "insert into `wishlist`(`userid`,`productid`) select `users`.`id`,$productid from `users` where `users`.`username` = '$username'";
		$result = mysqli_query($conn,$query);
		if ($result) {
			$final = 1;
		}
	}
	echo $final;
}

else if ($purpose == 'getcategoryandsubcategory') {
	$productid = $_POST["productid"];
	$username = $_POST["username"];

	$query = "select `categoryid`,`subcategoryid` from `product` where `product`.`id` = $productid and NULLIF(`product`.`deletedyn`,'') IS NULL";
	$result = mysqli_query($conn,$query); 
	if ($result->num_rows > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$names[] = array(
				'categoryid' => $row['categoryid'],
				'subcategoryid' => $row['subcategoryid']
			);
		}
		echo json_encode($names);
    }
}
else if ($purpose == 'pushreviews') {
	$productid = $_POST["productid"];
	$rate = $_POST["rating"];
	$username = $_POST["username"];
	$comment = $_POST["comment"];

	$query = "select `review`.`userid` from `users`,`review`,`product` where `users`.`username` = '$username' and `review`.`userid` = `users`.`id` and NULLIF(`review`.`deletedyn`,'') IS NULL and `product`.`id` = `review`.`productid` and `review`.`productid` = $productid and NULLIF(`product`.`deletedyn`,'') IS NULL";
	$result = mysqli_query($conn,$query); 
	if ($result->num_rows > 0) {
		$query = "update `review` set `rating` = $rate,`feedback` = '$comment',`datereviewed` = DATE_FORMAT(now(), '%Y-%m-%d %H-%i-%s') where `review`.`productid` = $productid and `review`.`userid` in (select `users`.`id` from `users` where `users`.`username` = '$username')";
		$updateresult = mysqli_query($conn,$query);
		if($updateresult) {
        	$final = 'Updated';
        }
    }
	else {
		$query = "insert into `review`(`userid`,`productid`,`rating`,`feedback`,`datereviewed`) select `users`.`id`,$productid,$rate,'$comment',DATE_FORMAT(now(), '%Y-%m-%d %H-%i-%s') from `users` where `users`.`username` = '$username'";
		echo $query;
		$result = mysqli_query($conn,$query);
		if ($result) {
			$final = 'Inserted';
		}
	}
	echo $final;
}

else if ($purpose == 'updatereview') {
	$productid = $_POST["productid"];
	$username = $_POST["username"];
	$review = $_POST["review"];

	$query = "update `review` set `feedback` = '$review',`datereviewed` = DATE_FORMAT(now(), '%Y-%m-%d %H-%i-%s') where `review`.`productid` = $productid and `review`.`userid` in (select `users`.`id` from `users` where `users`.`username` = '$username') and NULLIF(`review`.`deletedyn`,'') IS NULL";

	$result = mysqli_query($conn,$query);
	if($result) {
      	echo 'Updated';
    }
}
else if ($purpose == 'getwishlist') {
	$username = $_POST["username"];

		$query = "select distinct `wishlist`.`productid` from `users`,`wishlist`,`product` where `users`.`username` = '$username' and `wishlist`.`userid` = `users`.`id` and NULLIF(`wishlist`.`deletedyn`,'') IS NULL";
		$result = mysqli_query($conn,$query); 
	
	
		if($result->num_rows > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$productids[] = $row['productid'];
			}
			$productids = implode ( ', ', $productids);
		
			$query = "SELECT `products`.`pid` as 'productid',`product_name`,`products`.`brand`,`products`.`features`,`products`.`images`,`brandid`,`featureid`,`products`.`content`,`products`.`price` from (select `product`.`content`,`product`.`price`,`brand`.`id` as 'brandid',`features`.`id` as 'featureid',`product`.`id` as 'pid',`product`.`name` as 'product_name',`brand`.`name` as 'brand',GROUP_CONCAT(`features`.`name`) as 'features',`product`.`images` as 'images' from `product`,`category`,`subcategory`,`brand`,`features`, `product_features`where `product`.`id` = `product_features`.`productid` and `product`.`categoryid` = `category`.`id` and `product`.`subcategoryid` = `subcategory`.`id` and `product`.`brandid` = `brand`.`id` and `product_features`.`featureid` = `features`.`id` and `product`.`id` in ($productids) and NULLIF(`product`.`deletedyn`,'') IS NULL group by `product`.`name`,`category`.`name`,`subcategory`.`name`,`brand`.`name`) products order by `products`.`pid`";


			$result = mysqli_query($conn,$query);
	
			if ($result->num_rows > 0) {
				while($row = mysqli_fetch_assoc($result)) {
					$names[] = array(
						'id' => $row['productid'],
						'name' => $row['product_name'],
						'images' => $row['images'],
						'rating' => $row['rating'],
						'recentreview' => $row['recentreview'],			
						'brand' => $row['brand'],
						'features' => $row['features'],
						'brandid' => $row['brandid'],
						'featureid' => $row['featureid']
					);
				}
				echo json_encode($names);
			}
			else{
				echo 0;
			}
    	}
    
    
}

else if ($purpose == 'removewish') {
	$username = $_POST["username"];
	$productid = $_POST["productid"];

	$query = "delete from wishlist where `wishlist`.`userid` in  (select `users`.`id` from `users` where `users`.`username` = '$username') and `wishlist`.`productid` = $productid";
	$result = mysqli_query($conn,$query); 
	
	if($result){
		echo true;
	}
	else{
		echo "<b>Product not found</b>";
	}
}
else if ($purpose == 'deletereview') {	
	$productid = $_POST["productid"];
	$username = $_POST["username"];
	$review = $_POST["review"];

	$query = "update `review` set `deletedyn` = 'Y' where `review`.`productid` = $productid and `review`.`userid` in (select `users`.`id` from `users` where `users`.`username` = '$username') and NULLIF(`review`.`deletedyn`,'') IS NULL";

	$result = mysqli_query($conn,$query);

	if($result) {
      	echo 'Deleted';
    }
}
else if($purpose == 'addcategory') {
	$name = $_POST["name"];
	$image = $_POST["image"];
	$query = "INSERT INTO `category` (name,image) VALUES ('$name','$image')";
	$result = mysqli_query($conn,$query);
	if(! $result ) {
      die('Could not enter data: ' . mysql_error());
   }
   echo "Entered data successfully";
}
else if($purpose == 'deleteCategory') {
	$id = $_POST["id"];
	$query = "DELETE FROM `category` WHERE `category`.`id` = $id";
	$result = mysqli_query($conn,$query);
	if(! $result ) {
      die('Could not delete data: ' . mysql_error());
   }
   echo "Deleted data successfully";
}
else if($purpose == 'updatecategory') {
	$id = $_POST["id"];
	$name = $_POST["name"];
	$image = $_POST["image"];
	$query = "UPDATE `category` SET `name`='$name',`image`='$image' WHERE `category`.`id` = $id";
	$result = mysqli_query($conn,$query);
	if(! $result ) {
      die('Could not enter data: ' . mysql_error());
   }
   echo "Updated data successfully";
}
else if($purpose == 'deletesubcategory') {
	$id = $_POST["id"];
	$query = "DELETE FROM `subcategory` WHERE `subcategory`.`id` = $id";
	$result = mysqli_query($conn,$query);
	if(! $result ) {
      die('Could not delete data: ' . mysql_error());
   }
   echo "Deleted data successfully";
}
else if($purpose == 'updatesubcategory') {
	$id = $_POST["id"];
	$name = $_POST["name"];
	$image = $_POST["image"];
	$query = "UPDATE `subcategory` SET `name`='$name',`image`='$image' WHERE `subcategory`.`id` = $id";
	$result = mysqli_query($conn,$query);
	if(! $result ) {
      die('Could not enter data: ' . mysql_error());
   }
   echo "Updated data successfully";
}
else if ($purpose == 'addsubcategory') {
	$name = $_POST["name"];
	$category = $_POST["category"];
	$image = $_POST["image"];
	$query = "INSERT INTO `subcategory` (categoryid,name,image) VALUES ('$category','$name','$image')";
	$result = mysqli_query($conn,$query);
	if(! $result ) {
      die('Could not enter data: ' . mysql_error());
   }
   echo "Entered data successfully";
}
else  if ($purpose == 'addproduct') {
	$name = $_POST["name"];
	$brand = $_POST["brand"];
	$price = $_POST["price"];
	$desc = $_POST["desc"];
	$feature = $_POST["feature"];
	$image = $_POST["image"];
	$category = $_POST["category"];
	$subcategory = $_POST["subcategory"];

	$query = "SELECT `id` from `brand` where `name` = '$brand'";
	$result = mysqli_query($conn,$query);
	if ($result->num_rows > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$brandid = $row['id'];
		}
	}else{
		$query = "INSERT INTO `brand` (name) VALUES ('$brand')";
		$result = mysqli_query($conn,$query);
		if(! $result ) {
			die('Could not enter data: ' . mysql_error());
		}
		$brandid = $conn->insert_id;
	}

	$query = "SELECT `id` from `features` where `name` = '$feature'";
	$result = mysqli_query($conn,$query);
	if ($result->num_rows > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$featureid = $row['id'];
		}
	}else{
		$query = "INSERT INTO `features` (name) VALUES ('$feature')";
		$result = mysqli_query($conn,$query);
		if(! $result ) {
			die('Could not enter data: ' . mysql_error());
		}
		$featureid = $conn->insert_id;
	}

	$query = "INSERT INTO `product` (name,categoryid,subcategoryid,brandid,price,date,content,images) VALUES ('$name',$category,$subcategory,$brandid,$price,CURDATE(),'$desc','$image')";
	$result = mysqli_query($conn,$query);
	if(! $result ) {
      die('Could not enter data: ' . mysql_error());
   	}
   	$productid = $conn->insert_id;
   	$query = "INSERT INTO `product_features` (featureid,productid) VALUES ($featureid,$productid)";
	$result = mysqli_query($conn,$query);
	if(! $result ) {
      die('Could not enter data: ' . mysql_error());
   	}
   	echo "Entered data successfully";
}
else if($purpose == 'updateproduct') {
	$name = $_POST["name"];
	$id = $_POST["id"];
	$brand = $_POST["brand"];
	$price = $_POST["price"];
	$desc = $_POST["desc"];
	$feature = $_POST["feature"];
	$image = $_POST["image"];
	$category = $_POST["category"];
	$subcategory = $_POST["subcategory"];

	$query = "SELECT `id` from `brand` where `name` = '$brand'";
	$result = mysqli_query($conn,$query);
	if ($result->num_rows > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$brandid = $row['id'];
		}
	}else{
		$query = "INSERT INTO `brand` (name) VALUES ('$brand')";
		$result = mysqli_query($conn,$query);
		if(! $result ) {
			die('Could not enter data: ' . mysql_error());
		}
		$brandid = $conn->insert_id;
	}

	$query = "SELECT `id` from `features` where `name` = '$feature'";
	$result = mysqli_query($conn,$query);
	if ($result->num_rows > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$featureid = $row['id'];
		}
	}else{
		$query = "INSERT INTO `features` (name) VALUES ('$feature')";
		$result = mysqli_query($conn,$query);
		if(! $result ) {
			die('Could not enter data: ' . mysql_error());
		}
		$featureid = $conn->insert_id;
	}
	$query = "UPDATE `product` SET `name`='$name',`brandid`=$brandid,`price`=$price,`content`='$desc',`images`='$image' WHERE `product`.`id` = $id";
	$result = mysqli_query($conn,$query);
	if(! $result ) {
      die('Could not enter data: ' . mysql_error());
   	}
   	echo "Updated data successfully";
}
else if($purpose == 'deleteproduct') {
	$id = $_POST["id"];
	$query = "DELETE FROM `product` WHERE `product`.`id` = $id";
	$result = mysqli_query($conn,$query);
	if(! $result ) {
      die('Could not delete data: ' . mysql_error());
   }
   echo "Deleted data successfully";
}
exit();	
?> 
