<?php 


     class DatabaseConnector {
        private const hostname = "localhost";
        private const dbusername = "root"; //getenv("UB_SPECTRUM_DB_USER");
        private const dbpassword = "";
        private const dbName = "spectrum"; //getenv("UB_SPECTRUM_DB");
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