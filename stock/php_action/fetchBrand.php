<?php 	

require_once 'core.php';

/*$sql = "SELECT brand_id, brand_name, brand_active, brand_status FROM brands WHERE brand_status = 1";
$result = $connect->query($sql);*/

       $stm =$pdo->prepare("SELECT brand_id,brand_name,brand_active,brand_status FROM brands WHERE brand_status =?");
						  
        $stm->execute([1]);
		$val = COUNT($stm->fetchAll());

$output = array('data' => array());
   echo $val;
if($val>0) { 

	$stm =$pdo->prepare("SELECT brand_id,brand_name,brand_active,brand_status FROM brands WHERE brand_status =?");
						  
	$stm->execute([1]);

 // $row = $result->fetch_array();
 $activeBrands = ""; 

 while($row = $stm->fetch(\PDO::FETCH_ASSOC)) {
	 
 	$brandId = $row['brand_id'];
 	// active 
 	if($row['brand_active'] == 1) {
 		// activate member
 		$activeBrands = "<label class='label label-success'>Available</label>";
 	} else {
 		// deactivate member
 		$activeBrands = "<label class='label label-danger'>Not Available</label>";
 	}

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editBrandModel" onclick="editBrands('.$brandId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeBrands('.$brandId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 		
 		$row['brand_name'], 		
 		$activeBrands,
 		$button
 		); 	
 } // /while 

} // if num_rows

//$connect->close();

	echo json_encode($output);