<?php 
 $filepath = realpath(__FILE__); 
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
}
?>