<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array(), 'order_id' => '');
// print_r($valid);
if($_POST) {	

	$orderDate 						= date('Y-m-d', strtotime($_POST['orderDate']));	
  $clientName 					= $_POST['clientName'];
  $clientContact 				= $_POST['clientContact'];
  $subTotalValue 				= $_POST['subTotalValue'];
  $vatValue 						=	$_POST['vatValue'];
  $totalAmountValue     = $_POST['totalAmountValue'];
  $discount 						= $_POST['discount'];
  $grandTotalValue 			= $_POST['grandTotalValue'];
  $paid 								= $_POST['paid'];
  $dueValue 						= $_POST['dueValue'];
  $paymentType 					= $_POST['paymentType'];
  $paymentStatus 				= $_POST['paymentStatus'];

				
	/*$sql = "INSERT INTO orders (order_date, client_name, client_contact, sub_total, vat, total_amount, discount, grand_total, paid, due, payment_type, payment_status, order_status) VALUES ('$orderDate', '$clientName', '$clientContact', '$subTotalValue', '$vatValue', '$totalAmountValue', '$discount', '$grandTotalValue', '$paid', '$dueValue', $paymentType, $paymentStatus, 1)";*/
	
	try{


		
		$stmt= $pdo->prepare('INSERT INTO orders(order_id,order_status,order_date,client_name,client_contact,sub_total,vat,total_amount,grand_total,discount,paid,payment_type,payment_status)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)');
		
		$ok=$stmt->execute([$order_id,1,$orderDate,$clientName,$clientContact,$subTotalValue,$vatValue,$totalAmountValue,$grandTotalValue,$discount,$paid,$paymentType,$paymentStatus]);
	
	
	   }catch(Exception $e){
		echo 'exeption:', $e->getMessage();
	
	   }
	$order_id;
	$orderStatus = false;
	if($ok) {
		/*$stm =$pdo->prepare("SELECT * FROM orders  ORDER BY DESC LIMIT ?");
		$stm->execute([1]);
		$row = $stm->fetch(\PDO::FETCH_ASSOC);
		$order_id = $row['order_id'];
		//$order_id = $pdo->LAST_INSERT_ID;*/
		try{
			$stm =$pdo->query("SELECT * FROM orders");
			$v = COUNT($stm->fetchAll());
			
				//$stm->execute();
			//$row = $stm->fetch(\PDO::FETCH_ASSOC);
			$order_id = $v;
			echo 'dans le script php';
		
		}catch(Exception $e){
			echo 'exeption:', $e->getMessage();
		}
		$valid['order_id'] = $order_id;	

		$orderStatus = true;
	}

		
	// echo $_POST['productName'];
	$orderItemStatus = false;

	for($x = 0; $x < count($_POST['productName']); $x++) {			
		/*$updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = ".$_POST['productName'][$x]."";
		$updateProductQuantityData = $connect->query($updateProductQuantitySql);*/
		$stm =$pdo->prepare("SELECT product.quantity FROM product WHERE product.product_id =?");
						  
        $stm->execute([$_POST['productName'][$x]]);
		  echo $_POST['productName'][$x];
		while ($row = $stm->fetch(\PDO::FETCH_ASSOC)) {
			$updateQuantity[$x] = $row['quantity'] - $_POST['quantity'][$x];							
				// update product table
			/*	$updateProductTable = "UPDATE product SET quantity = '".$updateQuantity[$x]."' WHERE product_id = ".$_POST['productName'][$x]."";
				$connect->query($updateProductTable);*/

				$stm =$pdo->prepare("UPDATE product SET quantity = '".$updateQuantity[$x]."' WHERE product_id =?");
						  
       		    $stm->execute([$_POST['productName'][$x]]);

				// add into order_item
				/*$orderItemSql = "INSERT INTO order_item (order_id, product_id, quantity, rate, total, order_item_status) 
				VALUES ('$order_id', '".$_POST['productName'][$x]."', '".$_POST['quantity'][$x]."', '".$_POST['rateValue'][$x]."', '".$_POST['totalValue'][$x]."', 1)";

				$connect->query($orderItemSql);		*/

				$stmt= $pdo->prepare('INSERT INTO order_item(order_id,product_id,quantity,rate,total,order_item_status)VALUES(?,?,?,?,?,?)');
	
                 $ok=$stmt->execute([$order_id,$_POST['productName'][$x],$_POST['quantity'][$x],$_POST['rateValue'][$x],$_POST['totalValue'][$x],1]);

				if($x == count($_POST['productName'])) {
					$orderItemStatus = true;
				}		
		} // while	
	} // /for quantity

	$valid['success'] = true;
	$valid['messages'] = "Successfully Added";		
	
	//$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);