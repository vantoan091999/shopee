<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php include_once '../classes/category.php'?>

<?php

	$cat = new category();
	 if(!isset($_GET['catId'])||$_GET['catId'] == NULL){
        echo " <script> 'window.location = 'catlist.php'</script>";
     }else{
        $id = $_GET['catId'];
      
     }
     if($_SERVER['REQUEST_METHOD'] == 'POST'){ //form đăng nhập dùng phương thức post gửi dữ liệu
		$cateName = $_POST['catName'];
        $updatecat = $cat-> update_category($catName,$id);
     }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa danh mục </h2>
                
               <div class="block copyblock"> 
               <?php
               

                    if( isset( $updatecat) ){
                        echo  $updatecat;

                    }
                ?>
                <?php
                    $get_cat_name = $cat->getcatbyId($id);
                    if($get_cat_name){
                        while($result = $get_cat_name->fetch_assoc()){ 
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result ['catName'];?>" name = 'catName' placeholder="Sửa danh mục sản phẩm.." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Edit" />
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
<?php include 'inc/footer.php';?>