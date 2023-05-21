<?php 
include_once 'config/Database.php';
include_once 'class/Customer.php';

$database = new Database();
$db = $database->getConnection();

$customer = new Customer($db);

if(!$customer->loggedIn()) {	
	header("Location: login.php");	
}
include('inc/header.php');
?>
<title>phpzag.com : Demo Online Food Ordering System with PHP & MySQL</title>
  <link rel="stylesheet" type = "text/css" href ="css/foods.css">
<?php include('inc/container.php');?>
<div class="content">
	<div class="container-fluid">		
		
		<div class='row'>		
        <?php include('top_menu.php'); ?> 
		</div>
		<?php
		$orderTotal = 0;
		foreach($_SESSION["cart"] as $keys => $values){
			$total = ($values["item_quantity"] * $values["item_price"]);
			$orderTotal = $orderTotal + $total;
		}
		?>
		<div class='row'>
			<div class="col-md-6">
				<h3>Delivery Address</h3>
				<?php 
				$addressResult = $customer->getAddress();
				$count=0;
				while ($address = $addressResult->fetch_assoc()) { 
				?>
				<p><?php echo $address["address"]; ?></p>
				<p><strong>Phone</strong>:<?php echo $address["phone"]; ?></p>
				<p><strong>Email</strong>:<?php echo $address["email"]; ?></p>
				<?php
				}
				?>				
			</div>
			<?php 
			$randNumber1 = rand(100000,999999); 
			$randNumber2 = rand(100000,999999); 
			$randNumber3 = rand(100000,999999);
			$orderNumber = $randNumber1.$randNumber2.$randNumber3;
			?>
			<div class="col-md-6">
				<h3>Order Summery</h3>
				<p><strong>Items</strong>: $<?php echo $orderTotal; ?></p>
				<p><strong>Delivery</strong>: $0</p>
				<p><strong>Total</strong>: $<?php echo $orderTotal; ?></p>
				<p><strong>Order Total</strong>: $<?php echo $orderTotal; ?></p>
				<p><a href="process_order.php?order=<?php echo $orderNumber;?>"><button class="btn btn-warning">Place Order</button></a></p>
			</div>
		</div>
		   
    </div>        
		
<?php include('inc/footer.php');?>
