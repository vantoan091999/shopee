<?php
    //format class;
    class Format{
         public function FunctionDate($date)
        {
            return date( 'F i, Y,g:ia',strtotime($date));
        }
    
    public function textshorten($text,$limit = 400){  

        $text = $text."";
        $text = substr($text,0,$limit);
        $text = $text . "....";
        return $text; 
    }
     public function validation($data)
        //hàm này kiểm tra coi các biến $adminUser hợp lệ k 
    {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    public function title(){

        $path = $_SERVER['SCRIPT_FILENAME'];
        $title = basename($path, '.php');
    if($title == 'index'){
        $title = 'home';
    }
        elseif($title == 'contact' ){
            $title = 'contact';
        }
    return $tile = ucfirst($title);
    }
}
?>