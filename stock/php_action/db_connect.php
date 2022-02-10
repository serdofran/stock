<?php

//use GuzzleHttp\Promise\Create;

/*$pdo->query('CREATE TABLE IF NOT EXISTS "produit" ( 
	
	"id_pro" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 
	"npro" VARCHAR, 
	"cout" VARCHAR)');
$pdo->exec('BEGIN');
$pdo->prepare('INSERT INTO "produit"("id_pro","npro","cout")VALUES(:id_pro,:npro,:cout)');
$s->bindValue(':npro','jffh456');
$s->bindValue(':cout','jffh456');*/

try{
 
  $pdo = new pdo("sqlite:/opt/lampp/htdocs/stock/php_action/mybaseStock.db");

  //users
	$pdo->query('CREATE TABLE IF NOT EXISTS "users" ( 
	
		"user_id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 
		"username" VARCHAR, 
		"password" VARCHAR)');

		//brands

		$pdo->query('CREATE TABLE IF NOT EXISTS "brands" ( 
	
			"brand_id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 
			"brand_name" VARCHAR(255), 
			"brand_active" INTEGER,
			"brand_status" INTEGER)'
			);

		//categories


		$pdo->query('CREATE TABLE IF NOT EXISTS "categories" ( 
	
			"categories_id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 
			"categories_name" VARCHAR, 
			"categories_active" VARCHAR,
			"categories_status" VARCHAR)'
			);
			//product
			$pdo->query('CREATE TABLE IF NOT EXISTS "product" ( 
	
				"product_id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 
				"brand_id" VARCHAR, 
				"categories_id" VARCHAR,
				"product_name" VARCHAR,
				"active" VARCHAR,
				"quantity" VARCHAR,
				"status" VARCHAR,
				product_image VARCHAR,
				"rate" VARCHAR)'
				);

				//orders

				$pdo->query('CREATE TABLE IF NOT EXISTS "orders" ( 
	
					"order_id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 
					"order_status" VARCHAR, 
					"order_date" VARCHAR,
					"client_name" VARCHAR,
					"client_contact" VARCHAR,"quantity" VARCHAR,
					"sub_total" VARCHAR,
					 "vat" VARCHAR,
					 "total_amount" VARCHAR,
					 "grand_total" VARCHAR,
					 "discount" VARCHAR,
					 "paid" VARCHAR,
					 "payment_type" VARCHAR,
					 "payment_status" VARCHAR)'
					 
					);
		//order_item

		$pdo->query('CREATE TABLE IF NOT EXISTS "order_item" ( 
	
			"order_item_id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 
			"order_id" VARCHAR(255),
			"product_id" VARCHAR(255),
			"quantity"VARCHAR(255),
			"rate" VARCHAR(255),
			"total" VARCHAR(255),
			"order_item_status" VARCHAR)'
			);

  $stm =$pdo->prepare("SELECT * FROM users WHERE username=?");
  $stm->execute(['admin']);
  //$ve=$stm->fetchAll();
  
 /* $row = $stm->fetch(\PDO::FETCH_ASSOC);
  var_dump($row);*/
  $var =0;
  foreach($stm as $row){
	 $var =$var+1;
  
}

if($var == 0){
    $s =	$pdo->exec('INSERT INTO "users"("username","password")VALUES("admin","admin")');
   }


	if($s){
		echo "yes yes yes yes yes ----";
		//$state->fetchall();
	}
	else{
		 					
		echo "bad";
	}



}
catch(Exception $e){
echo 'exeption:', $e->getMessage();

}








?>