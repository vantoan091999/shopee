<?php 

  include '../lib/database.php';
  include '../helpers/format.php';

?>
<?php
  class brand
  {
      private $db;
      private $fm;
    public function __construct()
    {
        $this->db = new Database();//lấy class database truyền vào $db tương từ hàm format cũng vậy
        $this->fm = new Format();
    }
    public function insert_brand($brandName)
    {
        //kiểm tra xem có hợp lệ hay k (hàm validation)
        $brandName = $this->fm->validation($brandName);
       
        //liên kết dữ liệu sau khi kiểm tra xong 
        $brandName = mysqli_real_escape_string($this->db->link,$brandName);//$this->db->link dùng để liên kết dữ liệu ,$adminUser là dữ liệu
       
        //trường hợp ng dùng k nhập tên, mật khẩu 
        if(empty($brandName == "") ){
            $alert = " <span class =' error' >Isert brand not success  </span> ";
            return $alert;
        }else {
            $query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName') ";
            $result = $this->db->select($query);
            if($result == true){
                $alert = " <span class = 'success'>Insert brand successfully<?span>";
                return $alert;
            }else{
                $alert = " <span class ='error' >Isert brand not success  </span> ";
                return $alert;
            }
           
        }

    }
    public function show_brand(){
        $query ="SELECT *FROM tbl_brand order by branhID desc";
        $result = $this->db->select($query);
        
        return $result;
       }

       public function getbrandbyId($id)
       {
           $query = "SELECT*FROM tbl_brand*where brandID = '$id' ";
           $result = $this->db->select($query);
           return $result;
           
       }
       public function update_brand($brandName,$id)
       {
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link,$brandName);
        $id = mysqli_real_escape_string($this->db->link,$id);
        if(empty($brandName) == ""){
            $alert = " <span class =' error' >brand must be not emty </span> ";
            return $alert;
        }else {
            $query = " UPDATE tbl_brand SET catName = '$brandName' WHERE brandID = '$id' ";
            $result = $this->db->update($query);
            if($result == true)
            {
                $alert = " <span class = 'success'>brand update successfully<?span>";
                return $alert;
            }
            else{
                $alert = " <span class ='error' > brand update  not success  </span> ";
                return $alert;
            }
           
        }
       }
       public function del_brand($id)
       {
        $query = "DELETE*FROM tbl_brand*where brandID = '$id' ";
        $result = $this->db->delete($query);
        if($result == true){
            $alert = " <span class = 'success'>band delete successfully<?span>";
            return $alert;
        }else{
            $alert = " <span class ='error' > brand delete  not success  </span> ";
            return $alert;
        return $result; 
       }
  }
}
?>