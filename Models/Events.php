<?php
    require_once "DatabaseConnector.php";

    class Events extends DatabaseConnector {

        public static function getAll($startTime = '', $endTime=''){
            $temparray = array();
            $conn = self::getDB();

            $fetchEventsQuery = "SELECT ID, NAME, VENUE, APPROVAL_STATUS, DATE_FORMAT(START_TIME, '%Y-%m-%dT%TZ') AS START_TIME,DATE_FORMAT(END_TIME, '%Y-%m-%dT%TZ') AS END_TIME, CATEGORY, DESCRIPTION, LINK, PHONE, EMAIL  FROM tbl_events WHERE 1=1";

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

        public static function getEventFlyer($eventId){
            $temparray = array();
            $conn = self::getDB();
            $eventId = $conn->real_escape_string($eventId);
            $fetchFlyerQuery = "SELECT ID,NAME, ADDITIONAL_FILE, ADDITIONAL_FILE_SIZE, ADDITIONAL_FILE_TYPE FROM tbl_events WHERE ID=$eventId;";
            $result = mysqli_query($conn,$fetchFlyerQuery);

            if($result != NULL){
                while($row = mysqli_fetch_assoc($result))
                {
                    $temparray[] = $row;
                }
            }

            if(sizeof($temparray) > 0){
                return $temparray[0];
            } else {
                return NULL;
            }
        }

        public static function addEvent($name, $addedBy, $venue, $startTime, $endTime, $description, $link, $cost, $phone, $email,$ubCampusLocation="", $additionalFile="",$additionalFileSize="",$additionalFileType="", $approvalStatus = "pending", $categories="", $contacts=array()){
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
            $ubCampusLocation = $conn->real_escape_string($ubCampusLocation);
            $additionalFile= $conn->real_escape_string($additionalFile);
            $additionalFileSize = $conn->real_escape_string($additionalFileSize);
            $additionalFileType = $conn->real_escape_string($additionalFileType);
            $categories = $conn->real_escape_string($categories);
            $approvalStatus = $conn->real_escape_string($approvalStatus);
            $addedBy = $conn->real_escape_string($addedBy);
            $categories = $conn->real_escape_string($categories);

            session_start();
            if ($_SESSION == array() || !isset($_SESSION['sessionID'])) {
              $approvalStatus = "pending";
            } else {
              $approvalStatus = "approved";
            }

            $stmt = $conn->prepare("INSERT INTO tbl_events(
                NAME,
                VENUE,
                START_TIME,
                END_TIME,
                DESCRIPTION,
                LINK,
                COST,
                PHONE,
                EMAIL,
                UB_CAMPUS_LOCATION,
                ADDITIONAL_FILE,
                ADDITIONAL_FILE_SIZE,
                ADDITIONAL_FILE_TYPE,
                APPROVAL_STATUS,
                ADDED_BY) VALUES (
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                '$additionalFile',
                ?,
                ?,
                ?,
                ? )");

            $stmt->bind_param("ssssssdsssisss",$name,
                $venue,
                $startTime,
                $endTime,
                $description,
                $link,
                 $cost,
                $phone,
                $email,
                $ubCampusLocation,
                // $additionalFile,
                 $additionalFileSize,
                $additionalFileType,
                $approvalStatus,
                $addedBy);

            $stmt->execute();
            $last_id = $conn->insert_id;
            $stmt->close();

            if(strlen($categories) > 0){
                $categoryIdList = explode(",",$categories);
                $stmt =$conn->prepare("INSERT INTO tbl_event_categories
                    (`EVENT_ID`,
                    `CATEGORY_ID`)
                    VALUES
                    (?,?);
                ");
                foreach ($categoryIdList as $categoryId) {

                    $stmt->bind_param("ii", $last_id, $categoryId);
                    $stmt->execute();
                }
                $stmt->close();
            }

            if(sizeof($contacts) > 0){
                $stmt =$conn->prepare("INSERT INTO tbl_event_contacts
                    (`EVENT_ID`,
                     `CONTACT_TYPE`,
                     `PERSON_NAME`,
                     `ADDITIONAL_INFO`)
                    VALUES
                    (?,?,?,?);
                ");
                foreach ($contacts as $contact) {
                    $stmt->bind_param("isss", $last_id, $contact['type'], $contact['name'], $contact['info']);
                    $stmt->execute();
                }
                $stmt->close();
            }


        }

        public static function getEventInfo($eventId){
            $fetchedEvent = array("ID"=>'', "NAME"=>'', "VENUE"=>'',"DATE"=> '', "START_TIME" => '', "END_TIME"=>'',"CATEGORY"=>'',"DESCRIPTION"=>'',"LINK"=>'',"PHONE"=>'',"EMAIL"=>'',"COST"=>'',"UB_CAMPUS_LOCATION"=>'', "APPROVAL_STATUS"=>'');
            $conn = self::getDB();
            $eventId = $conn->real_escape_string($eventId);
            $fetchFlyerQuery = "SELECT ID,NAME, ADDITIONAL_FILE, ADDITIONAL_FILE_SIZE, ADDITIONAL_FILE_TYPE,
            VENUE, DATE_FORMAT(START_TIME, '%W %M %D, %Y') AS DATE, DATE_FORMAT(START_TIME, '%k:%i %p') AS START_TIME,DATE_FORMAT(END_TIME, '%k:%i %p') AS END_TIME, CATEGORY, DESCRIPTION, LINK, PHONE, EMAIL,COST, UB_CAMPUS_LOCATION, APPROVAL_STATUS  FROM tbl_events WHERE ID=$eventId;";
            $result = mysqli_query($conn,$fetchFlyerQuery);

            if($result != NULL){
                while($row = mysqli_fetch_assoc($result))
                {
                   $fetchedEvent  = $row;
                }
            }

            return $fetchedEvent;
        }

    }

?>
