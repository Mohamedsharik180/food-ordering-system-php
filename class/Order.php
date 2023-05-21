<?php
class Order {	
   
	private $ordersTable = 'food_orders';	
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	
	public function insert(){		
		if($this->item_name) {
			$stmt = $this->conn->prepare("
			INSERT INTO ".$this->ordersTable."(`item_id`, `name`, `price`, `quantity`, `order_date`, `order_id`)
			VALUES(?,?,?,?,?,?)");		
			$this->item_id = htmlspecialchars(strip_tags($this->item_id));
			$this->item_name = htmlspecialchars(strip_tags($this->item_name));
			$this->item_price = htmlspecialchars(strip_tags($this->item_price));
			$this->quantity = htmlspecialchars(strip_tags($this->quantity));
			$this->order_date = htmlspecialchars(strip_tags($this->order_date));
			$this->order_id = htmlspecialchars(strip_tags($this->order_id));			
			$stmt->bind_param("isiiss", $this->item_id, $this->item_name, $this->item_price, $this->quantity, $this->order_date, $this->order_id);			
			if($stmt->execute()){
				return true;
			}		
		}
	}	
}
?>