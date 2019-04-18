
<?php
    // use PHPMailer\PHPMailer\PHPMailer;
    // require "vendor/autoload.php";
    require 'PHPMailerAutoload.php';

    class SpectrumEmail extends PHPMailer{
        private const hostname = "";
        private const port = 0;
        private const username = "";
        private const from = "";
        private const password = "";

        public function __construct(){
            parent::__construct(true);

            $this->isSMTP();
            $this->Port = self::port;
            $this->Host = self::hostname;
            $this->SMTPAuth = true;
            $this->Username = self::username;
            $this->Password = self::password;
            $this->SMTPSecure = 'tls';
            $this->WordWrap = 50;     
            $this->isHTML(true);
            $this->setFrom(self::from);
            $this->FromName = '';
        }
        
        public function sendMessage($to, $subject, $message, $altMessage = ""){
             $this->Subject = $subject;
             $this->Body    = $message;
             foreach ($to as $address) {
                $this->AddAddress($address);
             }
             $this->AltBody = $altMessage;
           
             if(!$this->send()) {
                $this->ClearAddresses();
                 return false;
             }

             $this->ClearAddresses();
             return true;

        }
    }
?>