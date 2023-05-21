<?php
class Food {	
   
	private $foodItemsTable = 'food_items';	
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	
	public function itemsList(){		
		$stmt = $this->conn->prepare("SELECT id, name, price, description, images, status FROM ".$this->foodItemsTable);				
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	
	
}
?>