<?php
    require_once "DatabaseConnector.php";

    class Events extends DatabaseConnector {

        public static function getAll($startTime = '', $endTime=''){
            $temparray = array();
            $conn = self::getDB();
            
            $fetchEventsQuery = "SELECT ID, NAME, VENUE, DATE_FORMAT(START_TIME, '%Y-%m-%dT%TZ') AS START_TIME,DATE_FORMAT(END_TIME, '%Y-%m-%dT%TZ') AS END_TIME, CATEGORY, DESCRIPTION, LINK, COST, PHONE, EMAIL  FROM tbl_events WHERE START_TIME >= NOW() ";

            if($startTime !== ''){
                $startTime = $conn->real_escape_string($startTime);
                $fetchEventsQuery .= "AND TIME >= $startTime ";
            }
        
            if($endTime !== ''){
                $endTime = $conn->real_escape_string($endTime);
                $fetchEventsQuery .= "AND TIME <= $endTime ";
            }

            $result = mysqli_query($conn,$fetchEventsQuery);
            if($result != NULL){
                while($row = mysqli_fetch_assoc($result))
                {
                    $temparray[] = $row;
                }
            } 

            return $temparray;
        }

        public static function addEvent($name, $venue, $startTime, $endTime, $description, $link, $cost, $phone, $email, $additionalFile="", $categories="", $approvalStatus = "pending"){
            $conn = self::getDB();
            $name = $conn->real_escape_string($name);
            $venue = $conn->real_escape_string($venue);
            $startTime = $conn->real_escape_string($startTime);
            $endTime = $conn->real_escape_string($endTime);
            $description = $conn->real_escape_string($description);
            $link = $conn->real_escape_string($link);
            $cost = $conn->real_escape_string($cost);
            $phone = $conn->real_escape_string($phone);
            $email = $conn->real_escape_string($email);
            $additionalFile = $conn->real_escape_string($additionalFile);
            $categories = $conn->real_escape_string($categories);
            $approvalStatus = $conn->real_escape_string($approvalStatus);

            $insertQuery = "INSERT INTO tbl_events(NAME, VENUE, START_TIME,END_TIME, DESCRIPTION, LINK, COST, PHONE, EMAIL) VALUES 
                                                  ('$name', '$venue', '$startTime', '$endTime','$description', '$link', '$cost', '$phone', '$email');";
            $result = mysqli_query($conn,$insertQuery);
            if($result){
                return TRUE;
            } else {
                return FALSE;
            }

        }

        
    }

?>