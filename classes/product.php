<?php 
  $filepath = realpath(dirname(__FILE__));  
  include_once ( $filepath.'/../lib/database.php');
  include_once ( $filepath .'/../helpers/format.php');
?>
<?php
  class product
  {
      private $db;
      private $fm;
    public function __construct()
    {
        $this->db = new Database();//lấy class database truyền vào $db tương từ hàm format cũng vậy
        $this->fm = new Format();
    }
    public function insert_product($data,$file) 
    {
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);
       //kiểm tra hình ảnh và lấy hình ảnh cho vào foldẻ upload
        $premited = array('jpg','jpeg','png','gif');
        
        $file_name = $_FILES['image']["name"];//khai báo tên file đăng nhập 
        $file_size = $_FILES['image']["size"];//khai báo kích cỡ file
        $file_temp = $_FILES['image']["tmp_name"];//khai bao temp_name

        $div = explode('.',$file_name);
        $file_ext = strtolower(end($div));//đổi tất cả các chữ hoa thành chữ thường 
        $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;

        if($productName == "" || $brand == "" || $category == "" || $product_desc == "" || $type == "" || $price == "" || $file_name =="" )
        {
            $alert = " <span class ='error' >fiels must be not empty  </span> ";
            return $alert;
        }else {
            move_uploaded_file($file_temp,$uploaded_image);
            $query = "INSERT INTO tbl_product(productName,brandID,catId,product_desc,type,price,image) VALUES('$productName','$brand','$category','$product_desc','$type','$price','$unique_image') ";
            $result = $this->db->insert($query);
            
            if($result){
                $alert = " <span class = 'success'>Insert product successfully<?span>";
                return $alert;
            }else{
                $alert = " <span class ='error' >Isert product not success  </span> ";
                return $alert;
            }
        }
    }
    public function show_product(){
        // cách 1

        $query ="SELECT tbl_product.*,tbl_category.catName, tbl_brand.brandName
        From tbl_product INNER JOIN tbl_category on tbl_product.catId = tbl_category.catId
        INNER JOIN tbl_brand on tbl_product.brandID = tbl_brand.brandID
         order by tbl_product.productId desc";

        // cách 2
        // $query ="SELECT *FROM tbl_product order by productId desc";

        //cách 3
        // $query ="SELECT p.*,c.catName,b.brandName
        //  From tbl_product AS p,tbl_category AS c,tbl_brand AS b WHERE p.catId = c.catId
        //  AND p.brandID = b.brandID
        //  order by p.productId desc";
        $result = $this->db->select($query);
        return $result;
       }

       public function getproductbyid($id)
       {
           $query = "SELECT * FROM tbl_product where productId = '$id'";
           $result = $this->db->select($query);
           return $result; 
       }
       public function update_product($data,$file,$id)
       {
       
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);
       //kiểm tra hình ảnh và lấy hình ảnh cho vào foldẻ upload
        $premited = array('jpg','jpeg','png','gif');
        $file_name = $_FILES['image']["name"];
        $file_size = $_FILES['image']["size"];
        $file_temp = $_FILES['image']["tmp_name"];

        //tách image thành 2 phần là đầu và đuôi cách nhau bằng dấu "."
        $div = explode('.',$file_name);
        //lấy đuôi của image
        $file_ext = strtolower(end($div));
        // $file_current = strtolower(current($div));lấy tên file image
        //random số từ 0->10 kết hợp với $dile_ext để tạo thành tên mới để thêm vào cơ sở dữ liệu
        $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;

         if($productName == "" || $brand == "" || $category == "" || $product_desc == "" || $type == "" || $price == ""  )
         {
            $alert = " <span class ='error'>fiels must be not empty  </span> ";
            return $alert;
         }else
         { //nếu các giá trị khác rỗng thì chạy tiếp cái else
            if(!empty($file_name))
             {  //nếu người dùng chọn ảnh 
                if($file_name > 20480) //nếu file ảnh lớn hơn kích cỡ 20480 thì báo lỗi. return alert và dừng chương trình
                {
                    $alert = " <span class = 'success'>Image size should be less then 1MB!<?span>";
                    return $alert;
                }
                elseif(in_array($file_ext, $premited) === false) //báo lỗi và dừng chương trình
                    {
                    //echo "<span class ='error'> You can upload only:-",implode(',',$premited)."</span>"
                    $alert = " <span class ='error'> You can upload only:-".implode(',', $premited)."</span>";
                    return $alert;
                    }
                    $query = " UPDATE tbl_product SET 
                    productName = '$productName',brandID = '$brand',catId = '$category',
                    type = '$type',price = '$price',image = '$unique_image',
                    product_desc = '$product_desc' WHERE productId = '$id' ";
                    //câu query(truy vấn) này sẽ được thực thi nếu người dùng đã nhập ảnh và ảnh đúng chuẩn
                }
         else{
             //nếu người dùng không chọn ảnh thì câu query sẽ không có trường image. tức là ko up image vào database
            $query = " UPDATE tbl_product SET productName = '$productName',
            brandID ='$brand',catId = '$category',type = '$type',
            price = '$price',product_desc ='$product_desc' WHERE productId = '$id' ";
            }
            // $query sẽ nhận lấy 1 giá trị duy nhất ở bên trên vì chỉ có 2 trường hợp xảy ra
            $result = $this->db->update($query);
            if($result)
            {
                $alert = " <span class = 'success'>product update successfully<?span>";
                return $alert;
            }
            else{
                $alert = " <span class ='error' > product update  not success  </span> ";
                return $alert;
            }
        }
    }
       public function del_product($id)
       {
        $query = "DELETE FROM tbl_product where productId = '$id' ";
        $result = $this->db->delete($query);
        if($result){
            $alert = " <span style = 'color:green '  class = 'success'>product delete successfully</span>";
            return $alert;
        }else{
            $alert = " <span style = 'color:red ' class ='error' > product delete  not success  </span> ";
            return $alert;
       }
    }
    //END BACKend
    public function getproduct_feathered()
    {
        $query = "SELECT * FROM tbl_product where type = '0'";
           $result = $this->db->select($query);
           return $result;
    }
    public function getproduct_new()
    {
        $query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4" ;
        $result = $this->db->select($query);
        return $result;
    }
    public function get_details($id)
    {
        $query ="SELECT tbl_product.*,tbl_category.catName, tbl_brand.brandName
        From tbl_product INNER JOIN tbl_category on tbl_product.catId = tbl_category.catId
        INNER JOIN tbl_brand on tbl_product.brandID = tbl_brand.brandID
         WHERE tbl_product.productId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
}
?>