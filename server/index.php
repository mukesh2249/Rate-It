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

if ($purpose == 'getTopProducts') {
    $query = "select avg(`rating`) as toprated,`product`.`name`,`product`.`id`,`product`.`categoryid`,`product`.`subcategoryid`,`product`.`images` from `review`,`product` where `review`.`productid` = `product`.`id` group by `product`.`name`,`product`.`content` order by toprated desc limit 10";
	$result = mysqli_query($conn,$query);
	if ($result->num_rows > 0) {		
		while($row = mysqli_fetch_assoc($result)) {
			$names[] = array(			
				'name' => $row['name'],
				'id' => $row['id'],
				'category' => $row['categoryid'],
				'subcategory' => $row['subcategoryid'],
				'image' => $row['images']
			);
		}
		echo json_encode($names);
	}else{
		echo "No top Products";
	}
}
if ($purpose == 'getPopularCategories') {
    $query = "SELECT category.`name`,category.`image`,`category`.`id`,count(review.`id`) as `review_count` from category,`product`,`review` where category.`id` = product.`categoryid` and review.`productid` = product.`id` group by category.`name`,`category`.`id` order by count(review.`id`) desc limit 10";
	$result = mysqli_query($conn,$query);
	if ($result->num_rows > 0) {		
		while($row = mysqli_fetch_assoc($result)) {
			$names[] = array(			
				'name' => $row['name'],
				'id' => $row['id'],
				'image' => $row['image'],
				'review_count' => $row['review_count']
			);
		}
		echo json_encode($names);
	}else{
		echo "No top Products";
	}
}

exit();	
?> 