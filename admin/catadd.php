<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
    include '../classes/category.php'
?>
<?php
	$cat = new category();//tạo một biến mới bằng class bên file adminlogin.php đã tạo liên kết ở trên để gọi class
	if($_SERVER['REQUEST_METHOD'] == 'POST'){ //fform đăng nhập dùng phương thức post gửi dữ liệu
		$cateName = $_POST['catName'];//tạo biến để lấy giữ liệu từ mảng POST
		

		$insertcat = $cat->insert_category($cateName);
		// đặt 1 biến bằng class dùng '->'dấu mũi tên để triệu gọi hàm login_admin và truyền vào 2 biến trên để kiểm tra
	}

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm danh mục </h2>
                
               <div class="block copyblock"> 
               <?php
                    if( isset($insertcat) ){
                        echo $insertcat;
                    }
                ?>
                 <form action="catadd.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name = 'catName' placeholder="làm ơn thêm danh mục sản phẩm.." class="medium" />
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