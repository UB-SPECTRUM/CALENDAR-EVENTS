<?php
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");

    require_once "Models/Events.php";
    
    

    $name = $_POST['name'] or '';
    $venue = $_POST['venue'] or '';
    $description = $_POST['description'] or '';
    $link = $_POST['link'] or '';
    $ub_campus = $_POST['ub_campus'] or '';
    $cost = $_POST['cost'] or '';
    $date = $_POST['date'] or '';
    $start_time = $_POST['start_time'] or '';
    $end_time = $_POST['end_time'] or '';
    $flyer="";
    $flyerSize="";
    $flyerType="";
    if(isset($_FILES['flyer'] ) && $_FILES['flyer']['tmp_name'] != null){
        $flyer = file_get_contents($_FILES['flyer']['tmp_name']);
        $flyerSize = $_FILES['flyer']['size'];
        $file_info = new finfo(FILEINFO_MIME); 
        $mime_type = $file_info->buffer($flyer);  
        $flyerType = $mime_type;
    }
    
    $contact_count = $_POST['contact_count'] or 1;
    $eventId = $_POST['event_id'] or '';
    $ub_campus = $_POST['ub_campus'] or '';
    $categories =  $_POST['categories'] or '';

   $name = htmlentities(   $name);
   $venue = htmlentities(   $venue);
   $description = htmlentities(   $description);
   $link = htmlentities(   $link);
   $ub_campus = htmlentities(   $ub_campus);
   $cost = htmlentities(   $cost);
   $date = htmlentities(   $date);
   $start_time = htmlentities(   $start_time);
   $end_time = htmlentities(   $end_time);
   $contact_count = htmlentities($contact_count);
   $eventId = htmlentities($eventId);
   $ub_campus = htmlentities($ub_campus);
   $categories = htmlentities($categories);

    $start_time = "$date $start_time";
    $end_time = "$date $end_time";

    $contacts = array();
    for ($i=1; $i <= $contact_count; $i++) {
        $contactName = $_POST['contact_'.$i.'_name'] or '';
        $contactType = $_POST['contact_'.$i.'_type'] or '';
        $contactInfo = $_POST['contact_'.$i.'_info'] or '';

        $contactName = htmlentities($contactName);
        $contactType = htmlentities($contactType);
        $contactInfo = htmlentities($contactInfo);

        $contacts[] = array('name'=> $contactName, 'type' => $contactType, 'info' => $contactInfo);
    }


    Events::addEvent($name, $venue, $start_time, $end_time, $description, $link, $cost, "", "", $ub_campus, $flyer, $flyerSize,$flyerType, "pending", "", $categories, $contacts );

    $referer = dirname($_SERVER["HTTP_REFERER"]);
    header("Location: $referer");
    
?>