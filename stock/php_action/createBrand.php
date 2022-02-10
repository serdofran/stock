<?php 	
require_once 'core.php';
$valid['success'] = array('success' => false, 'messages' => array());
if($_POST) {	
	$brandName = $_POST['brandName'];
  $brandStatus = $_POST['brandStatus']; 
 try{
	 //echo $brandName;
	 $v=1;
	//$ok=$pdo->exec('INSERT INTO "brands"(brand_name,brand_active,"brand_status")VALUES($brandName,$brandStatus,1)');
	$stmt= $pdo->prepare('INSERT INTO brands(brand_name,brand_active,brand_status)VALUES(?,?,?)');
	
$ok=	$stmt->execute([$brandName,$brandStatus,1]);

}catch(Exception $e){
	echo 'exeption:', $e->getMessage();
	
	}
	//$sql = "INSERT INTO brands (brand_name, brand_active, brand_status) VALUES ('$brandName', '$brandStatus', 1)";
	if($ok) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the members";
	}
	 
	//$pdo->close();

	echo json_encode($valid);
 
}
//if $_POST
?>