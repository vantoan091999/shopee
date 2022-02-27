<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
    include '../classes/brand.php'
?>
<?php
	$brand = new brand();//tạo một biến mới bằng class bên file adminlogin.php đã tạo liên kết ở trên để gọi class
	if($_SERVER['REQUEST_METHOD'] == 'POST'){ //fform đăng nhập dùng phương thức post gửi dữ liệu
		$brandName = $_POST['brandName'];//tạo biến để lấy giữ liệu từ mảng POST
		

		$insertBrand = $brand->insert_brand($brandName);
		// đặt 1 biến bằng class dùng '->'dấu mũi tên để triệu gọi hàm login_admin và truyền vào 2 biến trên để kiểm tra
	}

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm thương hiệu </h2>
                
               <div class="block copyblock"> 
               <?php
                    if( isset($insertBrand) ){
                        echo $insertBrand;
                    }
                ?>
                 <form action="brandadd.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name = 'brandName' placeholder="làm ơn thêm thương sản phẩm.." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>