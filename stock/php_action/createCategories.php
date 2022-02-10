<?php 	
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
	$categoriesName = $_POST['categoriesName'];
  $categoriesStatus = $_POST['categoriesStatus']; 
   try{


	//echo $brandName;
	$v=1;
	//$ok=$pdo->exec('INSERT INTO "brands"(brand_name,brand_active,"brand_status")VALUES($brandName,$brandStatus,1)');
	$stmt= $pdo->prepare('INSERT INTO categories(categories_name,categories_active,categories_status)VALUES(?,?,?)');
	
    $ok=$stmt->execute([$categoriesName,$categoriesStatus,1]);


   }catch(Exception $e){
	echo 'exeption:', $e->getMessage();

   }
/*	

	$sql = "INSERT INTO categories (categories_name, categories_active, categories_status) 
	VALUES ('$categoriesName', '$categoriesStatus', 1)";*/

	if($ok === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the members";
	}

//	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST