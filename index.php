
<?php
	include_once 'include/footer.php';
	include_once 'include/slider.php';
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			  <?php
			  $product_fathered =$pd->getproduct_feathered();
			 if($product_fathered){
				 while($result = $product_fathered->fetch_assoc()){
			 
			  ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php"><img src="admin/uploads/<?php echo $Result['image'] ?>" alt="" /></a>
					 <h2><?php echo $result['productName'] ?> </h2>
					 <p><?php echo $fm->textshorten($result['product_desc'],50); ?></p>
					 <p><span class="price"><?php echo $Result['price']." "."VND"; ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ;?>" class="details">Details</a></span></div>
				</div>
				<?php
				 }
				}
				?>
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
			<?php
			  $product_new = $pd->getproduct_new();
			 if($product_new) {
				 while($Result_new = $product_new->fetch_assoc()){
			 
			  ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php"><img src="ad,im/uploads/<?php echo $Result['image']; ?>" alt="" /></a>
					 <h2><?php echo $Result_new['productName']; ?> </h2>
					 <p><?php echo $fm->textshorten($Result_new['product_desc'],50); ?></p>
					 <p><span class="price"><?php echo $Result_new['price']." "."VND" ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $Result_new['productId'];?>" class="details">Details</a></span></div>
				</div>
				<?php
				 }
				}
				?>
			</div>
    </div>
 </div>
<?php
	include ' footer';
?>
