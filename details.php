<?php
	include 'include/footer.php';
	include 'include/slider.php';
?>
<?php
	
    if(!isset($_GET['protId'])||$_GET['proId'] == NULL){
       echo " <script> 'window.location = '404.php'</script>";
    }else{
       $id = $_GET['productId'];
     
    }
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
			<?php 
			$get_product_details = $product->get_details($id);
			if($get_product_details){
				while($result_details = $get_product_details->fetch_assoc()){
			?>
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="images/preview-img.jpg" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productName'] ?></h2>
					<p><?php echo $fm->textshorten($result['product_desc'],100) ?></p>					
					<div class="price">
						<p>Price: <span><?php echo $result_details['price'] ?></span></p>
						<p>Category: <span><?php echo $result_details['catName'] ?></span></p>
						<p>Brand:<span><?php echo $result_details['brandName'] ?></span></p>
					</div>
				<div class="add-cart">
					<form action="cart.php" method="post">
						<input type="number" class="buyfield" name="" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>				
				</div>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<?php echo $fm->textshorten($result['product_desc'],120) ?>
	    </div>
				
	</div>
	<?php
				}
			}
	?>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
				      <li><a href="productbycat.php">Mobile Phones</a></li>
				     
    				</ul>
    	
 				</div>
 		</div>
 	</div>
 </div>
	 <?php
	include ' footer';
?>

	
