<?php 
 $filepath = realpath(dirname(__FILE__)); 
  include_once ($filepath.'/../lib/database.php');
  include_once ($filepath.'/../helpers/format.php');
?>
<?php
  class category
  {
      private $db;
      private $fm;
    public function __construct()
    {
        $this->db = new Database();//lấy class database truyền vào $db tương từ hàm format cũng vậy
        $this->fm = new Format();
    }
    public function insert_category($catName)
    {
        //kiểm tra xem có hợp lệ hay k (hàm validation)
        $catName = $this->fm->validation($catName);
       
        //liên kết dữ liệu sau khi kiểm tra xong 
        $catName = mysqli_real_escape_string($this->db->link, $catName);//$this->db->link dùng để liên kết dữ liệu ,$adminUser là dữ liệu
       
        //trường hợp ng dùng k nhập tên, mật khẩu 
        if(empty($catName)){
            $alert = " <span class ='error' >Isert category not success  </span> ";
            return $alert;
        }else {
            $query = "INSERT INTO tbl_category(catName) VALUES('$catName') ";
            $result = $this->db->insert($query);
            
            if($result){
                $alert = " <span class = 'success'>Insert catgory successfully<?span>";
                return $alert;
            }else{
                $alert = " <span class ='error' >Isert category not success  </span> ";
                return $alert;
            }
           
        }

    }
    public function show_category(){
        $query ="SELECT *FROM tbl_category order by catId desc";
        $result = $this->db->select($query);
        return $result;
       }

       public function getcatbyId($id)
       {
           $query = "SELECT * FROM tbl_category where catId = '$id'";
           $result = $this->db->select($query);
           
           return $result;
           
       }
       public function update_category($catName,$id)
       {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link,$catName);
        $id = mysqli_real_escape_string($this->db->link, $id);
        if(empty($catName)){
            $alert = " <span class =' error' >catgory must be not emty </span> ";
            return $alert;
        }else {
            $query = " UPDATE tbl_category SET catName = '$catName' WHERE catId = '$id' ";
            $result = $this->db->update($query);
            if($result)
            {
                $alert = " <span class = 'success'>catgory update successfully<?span>";
                return $alert;
            }
            else{
                $alert = " <span class ='error' > category update  not success  </span> ";
                return $alert;
            }
           
        }
       }
       public function del_category($id)
       {
        $query = "DELETE FROM tbl_category where catId = '$id' ";
        $result = $this->db->delete($query);
        if($result){
            $alert = " <span style = 'color:green '  class = 'success'>catgory delete successfully</span>";
            return $alert;
        }else{
            $alert = " <span style = 'color:red ' class ='error' > category delete  not success  </span> ";
            return $alert;
        
       }
  }
}
?>