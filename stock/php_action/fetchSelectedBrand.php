<?php 	

require_once 'core.php';

$brandId = $_POST['brandId'];

/*$sql = "SELECT brand_id, brand_name, brand_active, brand_status FROM brands WHERE brand_id = $brandId";
$result = $connect->query($sql);*/

$stm =$pdo->prepare("SELECT brand_id,brand_name,brand_active,brand_status FROM brands WHERE brand_status =?");
						  
$stm->execute([1]);
$val = COUNT($stm->fetchAll());

if($val) { 
    $stm =$pdo->prepare("SELECT brand_id,brand_name,brand_active,brand_status FROM brands WHERE brand_status =?");
						  
	$stm->execute([1]);

// $row = $result->fetch_array();
$row = $stm->fetch(\PDO::FETCH_ASSOC);
} // if num_rows

//$connect->close();

echo json_encode($row);