<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
 <?php  include_once '../classes/brand.php'?>   
<?php include_once '../classes/category.php' ?>
<?php include_once '../classes/product.php' ?>
<?php
	$product = new  product();
    if(!isset($_GET['productId'])||$_GET['productId'] == NULL){
       echo " <script> 'window.location = 'productlist.php'</script>";
    }else{
       $id = $_GET['productId'];
     
    }
	if($_SERVER['REQUEST_METHOD'] == 'POST'&& isset($_POST['submit'])) { 
		
		$update_product = $product->update_product($_POST,$_FILES,$id);
		
    }
    
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm sản phẩm</h2>
        <div class="block">
        <?php
                    if( isset($update_product) ){
                        echo $update_product;
                    }
                ?>        
                <?php
                $get_product_by_id = $product->getproductbyid($id);
                if($get_product_by_id){
                    while($result_product = $get_product_by_id->fetch_assoc()){
                
                ?>       
         <form  method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name = "productName" value="<?php echo $result_product['productName']?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="category">
                            <option>Select Category</option>
                            <?php
                                $cat = new category();
                                $catlist = $cat->show_category();
                                if($catlist){
                                    $i = 0;
                                    while($result_cat = $catlist->fetch_assoc()){
                            ?>
                            <option
                            <?php
                            if($result_cat['catId'] == $result_product['catId']){
                                echo "selected";}
                            ?>
                             value="<?php echo $result_cat['catId']?>"><?php echo $result_cat['catName']?></option>

                            <?php
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brand">
                            <option>Select Brand</option>
                            <?php
                            $brand = new brand();
							$brandlist = $brand->show_brand();
							if($brandlist){
								while($result_brand = $brandlist->fetch_assoc()){
						?>
                        <option
                         <?php
                        if($result_brand['brandID'] == $result_product['brandID']){
                                echo "selected";}
                         ?>
                        value=" <?php echo $result_brand['brandID']?>"><?php echo $result_brand['brandName']?></option>
                        <?php
                                }
                            }
                        ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea name = "product_desc" class="tinymce" value=" <?php echo $result_product['product_desc']?>"></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>price</label>
                    </td>
                    <td>
                        <input name = "price" type="text" value=" <?php echo $result_product['price']?>" class="medium" />
                    </td>
                </tr>
                
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                    <image src = "uploads/<?php echo $result_product['image']?> style = 'width: 20%;'"><br>
                        <input type="file"name = "image"/>
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <?php
                            if($result_product['type'] == 0){

                            
                            ?>
                            <option selected value="0">Featured</option>
                            <option value="1">Non-Featured</option>
                            <?php
                            }else{
                                
                            ?>
                            <option selected value="1">Featured</option>
                            <option value="0">Non-Featured</option>
                            <?php
                            
                            }
                            ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="update"/>
                    </td>
                </tr>
            </table>
            </form>
            <?php
                    }
                }
            ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>