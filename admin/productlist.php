<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php include_once '../classes/brand.php'?>
<?php include_once '../classes/category.php' ?>
<?php include_once '../classes/product.php' ?>
<?php include_once '../helpers/format.php' ?>
<?php 
	$fm = new Format();
	$product = new product();
	if(isset($_GET['productId'])){
		$id = $_GET['peoductId'];
		$delpd = $product->del_product($id);
   }
   ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Product Name</th>
					<th>Product price</th>
					<th>Product Image</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				
				
				$productlist = $product->show_product();
				if($productlist){
					$i= 0;
					while($result = $productlist->fetch_assoc()){
						$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $result['productName']?></td>
					<td><?php echo $result['price']?></td>
					<td><image src = "uploads/"<?php echo $result['image']?> style = "width:10%;"></td>
					<td><?php echo $result['catName']?></td>
					<td><?php echo $result['brandName']?></td>
					<td><?php echo $fm->textshorten( $result['product_desc'],50)?></td>
					<td><?php 
						if($result['type']==0){
							echo 'Feathered';
						}else{
							echo 'Non Feathered';
						}
					?></td>
					
					<td class="center"> 4</td>
					<td><a href="product_edit.php?productId=<?php echo $result ['productId']?>">Edit</a> || <a href="product_edit.php?productid=<?php
					 echo $result ['productId']?>">Delete</a></td>
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
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
