﻿<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
	include '../classes/category.php';
	if(isset($_GET['delid'])){
         $id = $_GET['delid'];
		 $delcat = $cat->del_category($id);
	}
?>
<?php
	$cat = new category();//tạo một biến mới bằng class bên file adminlogin.php đã tạo liên kết ở trên để gọi class
	
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">  
				<?php
                    if( isset( $dellcat) ){
                        echo  $dellcat;
                    }
                ?>      
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						
							$show_cate = $cat->show_category();
							if($show_cate){
								$i = 0;
								while($result = $show_cate->fetch_assoc()){
								$i++;

						?>
						<tr class="odd gradeX">
							<td><?php  echo $i;?></td>
							<td><?php echo $result['catName'];?></td>
							<td><a href="catedit.php ?catid = <?php echo $result['catId']?>">Edit</a> || <aoclick = "return confirm(
								'Are yout want to delete ?')" href="?delid = <?php echo $result['catId']?>">Delete</a></td>
						</tr>
						<?php 		
					}
						}
						?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
	$(document).ready(function(){
	    $setupLeftMenu();
	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>