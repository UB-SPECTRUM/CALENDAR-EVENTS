<?php 


     class DatabaseConnector {
        private const hostname = "";
        private const dbusername = "";
        private const dbpassword = "";
        private const dbName = ""; 
        private static $conn;
       
        protected static function getDB(){
            if(self::$conn === null){
                self::$conn = mysqli_connect(self::hostname, self::dbusername, self::dbpassword, self::dbName) or die('Unable to connect');
                mysqli_set_charset(self::$conn,'utf8');
            }
            
            return self::$conn;
        }
    }
?>