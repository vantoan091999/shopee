<?php
	include_once 'include/header.php';
	include_once 'include/slider.php';
?>
<div class="main">
    <?php
        echo session_id();
    ?>
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Feature Products</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
			  $product_fathered = $product->getproduct_feathered();
			 if($product_fathered){
				 while($result = $product_fathered->fetch_assoc()){
			 
			  ?>
            <div class="grid_1_of_4 images_1_of_4">
                <a href="details.php"><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></a>
                <h2><?php echo $result['productName'] ?> </h2>
                <p><?php echo $fm->textshorten($result['product_desc'],50); ?></p>
                <p><span class="price"><?php echo $result['price']." "."VND"; ?></span></p>
                <div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ;?>"
                            class="details">Details</a></span></div>
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
			  $product_new = $product->getproduct_new();
			 if($product_new) {
				 while($result_new = $product_new->fetch_assoc()){
			 
			  ?>
            <div class="grid_1_of_4 images_1_of_4">
                <a href="details.php"><img src="ad,im/uploads/<?php echo $result_new['image']; ?>" alt="" /></a>
                <h2><?php echo $result_new['productName']; ?> </h2>
                <p><?php echo $fm->textshorten($result_new['product_desc'],50); ?></p>
                <p><span class="price"><?php echo $result_new['price']." "."VND" ?></span></p>
                <div class="button"><span><a href="details.php?proid=<?php echo $result_new['productId'];?>"
                            class="details">Details</a></span></div>
            </div>
            <?php
				 }
				}
				?>
        </div>
    </div>
</div>
<?php
	include_once 'include/footer.php';
?>