<?php
	include 'include/header.php';
	//include 'include/slider.php';
?>
<?php   
    if($_SERVER['REQUEST_METHOD'] == 'POST'&& isset($_POST['submit'])) { //fform đăng nhập dùng phương thức post gửi dữ liệu
		$cartId = $_POST['cartId'];
        $quantity = $_POST['quantity'];
		$update_quantity_Cart = $cart->update_quantity_cart($quantity,$cartId);
		
    }
?>
<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2>Your Cart</h2>
                <?php
                    if(isset($update_quantity_Cart)){
                        echo $update_quantity_Cart;
                    }
                ?>
                <table class="tblone">
                    <tr>
                        <th width="20%">Product Name</th>
                        <th width="10%">Image</th>
                        <th width="15%">Price</th>
                        <th width="25%">Quantity</th>
                        <th width="20%">Total Price</th>
                        <th width="10%">Action</th>
                    </tr>
                    <?php
						$get_product_cart = $cart->getproduct_cart();
						if($get_product_cart){
							$subtotal = 0;
							while($result = $get_product_cart->fetch_assoc()){
                               	
					?>
                    <tr>
                        <td> <?php echo $result['productName'] ?> </td>
                        <td><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></td>
                        <td><?php echo $result['price'] ?></td>
                        <td>
                            <form action="" method="post">
                                <input type="number" name="quantity" min="0"
                                    value="<?php echo $result['quantity'] ?>" />
                                <input type="hidden" name="cartId" min="0" value="<?php echo $result['cartId'] ?>" />
                                <input type="submit" name="submit" value="Update" />
                            </form>
                        </td>
                        <td><?php
						$total = $result['price']*$result['quantity'];
						echo $total;  ?></td>
                        <td><a href="">X</a></td>
                    </tr>
                    <?php
					$subtotal += $total;	
					    }
					}
					?>
                </table>
                <table style="float:right;text-align:left;" width="40%">
                    <tr>
                        <th>Sub Total : </th>
                        <td><?php
							echo $subtotal; 
						?></td>
                    </tr>
                    <tr>
                        <th>VAT : </th>
                        <td>10%</td>
                    </tr>
                    <tr>
                        <th>Grand Total :</th>
                        <td> <?php
                            
							$vat = $subtotal * 0.1;
							$gtotal = $subtotal + $vat;
							echo $gtotal;
						?> </td>
                    </tr>
                </table>
            </div>
            <div class="shopping">
                <div class="shopleft">
                    <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                </div>
                <div class="shopright">
                    <a href="login.php"> <img src="images/check.png" alt="" /></a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php
	include_once 'include/footer.php';
?>