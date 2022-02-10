<?php 	



require_once 'core.php';

/*$sql = "SELECT product.product_id, product.product_name, product.product_image, product.brand_id,
 		product.categories_id, product.quantity, product.rate, product.active, product.status, 
 		brands.brand_name, categories.categories_name FROM product 
		INNER JOIN brands ON product.brand_id = brands.brand_id 
		INNER JOIN categories ON product.categories_id = categories.categories_id  
		WHERE product.status = 1";*/
		try{

			$stm =$pdo->prepare("SELECT product.product_id , product.product_name , product.product_image , product.brand_id , product.categories_id , product.quantity , product.rate , product.active , product.status , brands.brand_name , categories.categories_name FROM product INNER JOIN brands ON product.brand_id = brands.brand_id 
			INNER JOIN categories ON product.categories_id = categories.categories_id  
			WHERE product.status = ?");
			$stm->execute([1]);
			
			/*while($row = $stm->fetch(\PDO::FETCH_ASSOC)){

				echo $row['product_name'];

			}*/
			
		}catch(Exception $e){
			echo 'exeption:', $e->getMessage();
			
		}
		

//$result = $connect->query($sql);
$var = COUNT($stm->fetchAll());
//echo $var;

$stm =$pdo->prepare("SELECT product.product_id , product.product_name , product.product_image , product.brand_id , product.categories_id , product.quantity , product.rate , product.active , product.status , brands.brand_name , categories.categories_name FROM product INNER JOIN brands ON product.brand_id = brands.brand_id 
			INNER JOIN categories ON product.categories_id = categories.categories_id  
			WHERE product.status = ?");
			$stm->execute([1]);
			
			/*while($row = $stm->fetch(\PDO::FETCH_ASSOC)){

				echo $row['product_name'];

			}*/
			echo 'bien';

$output = array('data' => array());

if($var > 0) { 

 // $row = $result->fetch_array();
 $active = ""; 

 while($row = $stm->fetch(\PDO::FETCH_ASSOC)) {
 	$productId = $row['product_id'];
 	// active 
 	if($row['active'] == 1) {
 		// activate member
 		$active = "<label class='label label-success'>Available</label>";
 	} else {
 		// deactivate member
 		$active = "<label class='label label-danger'>Not Available</label>";
 	} // /else

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editProductModalBtn" data-target="#editProductModal" onclick="editProduct('.$productId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeProductModal" id="removeProductModalBtn" onclick="removeProduct('.$productId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

	// $brandId = $row[3];
	// $brandSql = "SELECT * FROM brands WHERE brand_id = $brandId";
	// $brandData = $connect->query($sql);
	// $brand = "";
	// while($row = $brandData->fetch_assoc()) {
	// 	$brand = $row['brand_name'];
	// }

	$brand = $row['brand_name'];
	$category = $row['categories_name'];

	$imageUrl = substr($row['product_name'], 3);
	$productImage = "<img class='img-round' src='".$imageUrl."' style='height:30px; width:50px;'  />";

 	$output['data'][] = array( 		
 		// image
 		$productImage,
 		// product name
 		$row['product_name'], 
 		// rate
 		$row['rate'],
 		// quantity 
 		$row['quantity'], 		 	
 		// brand
 		$brand,
 		// category 		
 		$category,
 		// active
 		$active,
 		// button
 		$button 		
 		); 	
 } // /while 

}// if num_rows

//$connect->close();

echo json_encode($output);