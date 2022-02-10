<?php 	

require_once 'core.php';

/*$sql = "SELECT categories_id, categories_name, categories_active, categories_status FROM categories WHERE categories_status = 1";
$result = $connect->query($sql);*/

$stm =$pdo->prepare("SELECT categories_id,categories_name,categories_active,categories_status FROM categories WHERE categories_status =?");
						  
$stm->execute([1]);
$val = COUNT($stm->fetchAll());

$output = array('data' => array());

if($val > 0) { 

 // $row = $result->fetch_array();
 $activeCategories = ""; 

 $stm =$pdo->prepare("SELECT categories_id,categories_name,categories_active,categories_status FROM categories WHERE categories_status =?");
						  
$stm->execute([1]);

 while($row = $stm->fetch(\PDO::FETCH_ASSOC)) {
 	$categoriesId = $row['categories_id'];
 	// active 
 	if($row['categpories_active'] == 1) {
 		// activate member
 		$activeCategories = "<label class='label label-success'>Available</label>";
 	} else {
 		// deactivate member
 		$activeCategories = "<label class='label label-danger'>Not Available</label>";
 	}

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editCategoriesModalBtn" data-target="#editCategoriesModal" onclick="editCategories('.$categoriesId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeCategoriesModal" id="removeCategoriesModalBtn" onclick="removeCategories('.$categoriesId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 		
 		$row[1], 		
 		$activeCategories,
 		$button 		
 		); 	
 } // /while 

}// if num_rows

//$connect->close();

echo json_encode($output);