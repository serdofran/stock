<?php 	
echo 'debut';
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

try{

	if($_POST) {	
		echo $_FILES['productImage']['tmp_name'];
		$productName 		= $_POST['productName'];
	   $productImage 	= $_POST['productImage'];
	  $quantity 			= $_POST['quantity'];
	  $rate 					= $_POST['rate'];
	  $brandName 			= $_POST['brandName'];
	  $categoryName 	= $_POST['categoryName'];
	  $productStatus 	= $_POST['productStatus'];
		
		$type = explode('.', $_FILES['productImage']['name']);
		
		$type = $type[count($type)-1];	
		
	
		$url = '../assests/images/stock/'.uniqid(rand()).'.'.$type;
		$ur = '/opt/lampp/htdocs/stock/assests/images/stock';
		$target_file= '../assests/images/stock/'.basename($_FILES['productImage']['tmp_name']);
		//$imagetype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		//echo $url;
		if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
			
	
			if(is_uploaded_file($_FILES['productImage']['tmp_name'])) {	
			//	echo $_FILES['productImage']['name'];
	
				if(move_uploaded_file($_FILES['productImage']['tmp_name'], $url)) {
					 echo '0';
					/*$sql = "INSERT INTO product (product_name, product_image, brand_id, categories_id, quantity, rate, active, status) 
					VALUES ('$productName', '$url', '$brandName', '$categoryName', '$quantity', '$rate', '$productStatus', 1)";*/
					   try{
	
						 echo '1';
					
						$stmt= $pdo->prepare('INSERT INTO product(product_name,product_image,brand_id,categories_id,quantity,rate,active,status)VALUES(?,?,?,?,?,?,?,?)');
						
						$ok=$stmt->execute([$productName,$url,$brandName,$categoryName,$quantity,$rate,$productStatus,1]);
						echo $ok;
					
					   }catch(Exception $e){
						echo 'exeption:', $e->getMessage();
					
					   }
					   echo '2';
					if($ok) {
						$valid['success'] = true;
						$valid['messages'] = "Successfully Added";	
					} else {
						$valid['success'] = false;
						$valid['messages'] = "Error while adding the members";
					}
	
				}	else {
					return false;
				}	// /else	
			} // if
		} // if in_array 		
	
		//$connect->close();
	
		echo json_encode($valid);
	 
	} // /if $_POST

}catch(Exception $e){
	echo 'exeption:', $e->getMessage();
	
	}