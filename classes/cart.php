<?php 
 $filepath = realpath(dirname(__FILE__));  
  include_once ($filepath.'/../lib/database.php');
  include_once ($filepath.'/../helpers/format.php');
?>
<?php
  class cart
  {
      private $db;
      private $fm;
    public function __construct()
    {
        $this->db = new Database();//lấy class database truyền vào $db tương từ hàm format cũng vậy
        $this->fm = new Format();
    }
    public function add_to_cart($quantity,$id)
    {
      $quantity = $this->fm->validation($quantity);
      $quantity = mysqli_real_escape_string($this->db->link,$quantity);
      $quantity = mysqli_real_escape_string($this->db->link, $quantity);
      $sId = mysqli_real_escape_string($this->db->link,$id);
      $sId=  session_id();
       
      $query = "SELECT * FROM tbl_product WHERE producId = '$id'";
      $result = $this->db->select($query)->fetch_assoc();
       
      $image = $result['image'];
      $price = $result['price'];
      $producName = $result['productName'];
       $check_cart  = " SELECT * FROM tbl_product WHERE producId = '$id'AND sId = '#sId'";
       if($check_cart){
         $msg = 'product already added';
         return $msg;
       }else{
         
       
      $query_insert = "INSERT INTO tbl_cart(productId,quantity,sId,image,type,price,productName) VALUES('$id','$quantity','$sId',' $image','$price','$producName') ";
            $insert_cart = $this->db->insert($query_insert);
            
            if($result){
               header('location:cart.php');
            }else{
                header('location:404.php');
            }
      }
    }
    public function getproduct_cart()
    {
      $sId=  session_id();
      $query = " SELECT * FROM tbl_cart WHERE sId = '$sId'";
      $result = $this->db->select($query);
      return $result; 
    }
    public function update_quantity_cart($quantity,$cartId)
    {
      $query = " UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId = 'cartId'";
      $result = $this->db->update($query);
      if($result){
        $msg = '<span class = "success" style ="color:green ; font-size:18px;">product quantity update successfully</span>';
        return $msg;
    }else{
        $msg = '<span class = "error" style ="color:red ; font-size:18px;>product quantity update not successfully</span>';
        return $msg;
      }
    }
}
?>