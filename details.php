<?php
	include 'include/header.php';
	// include 'include/slider.php';
?>
<?php
	
    if(!isset($_GET['proid'])||$_GET['proid'] == NULL){
       echo " <script> 'window.location = '404.php'</script>";
    }else{
       $id = $_GET['proid'];
     
    }
   if($_SERVER['REQUEST_METHOD'] == 'POST'&& isset($_POST['submit'])) { //fform đăng nhập dùng phương thức post gửi dữ liệu
		
        $quantity = $_POST['quantity'];
		$addtoCart = $cart->add_to_cart($quantity,$id);
		
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
                    <img src="admin/uploads/<?php echo $result_details['image'] ?>" alt="" />
                </div>
                <div class="desc span_3_of_2">
                    <h2><?php echo $result_details['productName'] ?></h2>
                    <p><?php echo $fm->textshorten($result_details['product_desc'],100) ?></p>
                    <div class="price">
                        <p>Price: <span><?php echo $result_details['price']." "."VND" ?></span></p>
                        <p>Category: <span><?php echo $result_details['catName'] ?></span></p>
                        <p>Brand:<span><?php echo $result_details['brandName'] ?></span></p>
                    </div>
                    <div class="add-cart">
                        <form action="cart.php" method="post">
                            <input type="number" class="buyfield" name="quantity" value="1" min="1" />
                            <input type="submit" class="buysubmit" name="submit" value="Buy Now" />
                        </form>

                    </div>
                    <?php
                            if(isset($addtoCart)){
                                echo '<span style = " color: red; font-size : 18px">product already added </span>';
                            }
                        ?>
                </div>
                <div class="product-desc">
                    <h2>Product Details</h2>
                    <?php echo $fm->textshorten($result_details['product_desc'],120) ?>
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
	include 'include/footer.php';
?>