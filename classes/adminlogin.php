<?php 
  include '../lib/session.php';
  session::checkLogin();
  include '../lib/database.php';
  include '../helpers/format.php';

?>
<?php
  class Adminlogin
  {
      private $db;
      private $fm;
    public function __construct()
    {
        $this->db = new Database();//lấy class database truyền vào $db tương từ hàm format cũng vậy
        $this->fm = new Format();
    }
    public function login_admin($adminUser,$adminPass)
    {
        //kiểm tra xem có hợp lệ hay k (hàm validation)
        $adminUser = $this->fm->validation($adminUser);
        $adminPass = $this->fm->validation($adminPass);
        //liên kết dữ liệu sau khi kiểm tra xong 
        $adminUser = mysqli_real_escape_string($this->db->link,$adminUser);//$this->db->link dùng để liên kết dữ liệu ,$adminUser là dữ liệu
        $adminPass = mysqli_real_escape_string($this->db->link,$adminPass);
        //trường hợp ng dùng k nhập tên, mật khẩu 
        if(empty($adminUser) || empty($adminPass) ){
            $alert = " user and Pass must be not empty";
            return $alert;
        }else {
            
            $query = " SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' LIMIT 1";
            //$query = "SELECT * FROM tbl_admin WHERE 1=1";
            $result = $this->db->select($query);
            if($result != false){
               
                $value = $result->fetch_assoc();//tìm hiểu 2 lệnh fetch_arrybà fetch_assoc;
                //trong session thông báo là adminlogin bằng true là cho phiên đăng nhập này có tên là adminlogin  thì 
                //ở bên session.php phải đổi sang adminlogin
                Session::set('adminlogin',true);
                Session::set('adminid',$value['adminid']);
                Session::set('adminUse',$value['adminUser']);
                Session::set('adminName',$value['adminName']);
                header('Location:index.php');
            }else{
                $alert = " user and Pass not match ";
                return $alert;
            }
        }

    }
  
  }
?>