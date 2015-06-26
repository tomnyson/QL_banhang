<?php
  class trangthai
  {
    public static $online=false;
    
    public static function is_login(){
        if(isset($_SESSION['user']))
        {
               return true;
        } 
        return false;       
    }
      public static function is_admin(){
        if(isset($_SESSION['admin'])&&$_SESSION['admin']=='admin')
        {
               return true;
        } 
        return false;       
    }
    
    public static function get_username(){
        if(isset($_SESSION['user']))
        {
               return $_SESSION['user']['username'];
        } 
        return '';       
    }
    public static function is_locked($ID){
		return DataProvider::Kiem_Tra_Khoa_Tai_Khoan($ID);		   
	}
    
    
  }
    
?>