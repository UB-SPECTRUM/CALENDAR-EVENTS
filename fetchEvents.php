<?php
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");

    require_once "Models/Events.php";

   

    // $startTime = htmlentities($_POST['start']) or '';
    // $endTime = htmlentities($_POST['end']) or '';
    // $categories = htmlentities($_POST['categories']) or '';

    //** */INSERT TEST EVENTS

    // Events::addEvent("Event 1", "Location 1", date ("Y-m-d H:i:s",  strtotime('2019-03-05T12:30:00')),date ("Y-m-d H:i:s",  strtotime('2019-03-05T13:30:00')),"Test Description 1", "https://google.com", "$100.00", "877-777-7777", "email@email.com" );
    // Events::addEvent("Event 2", "Location 2", date ("Y-m-d H:i:s",  strtotime('2019-03-06T13:30:00')),date ("Y-m-d H:i:s",  strtotime('2019-03-06T14:30:00')),"Test Description 2", "https://yahoo.com", "$50.00", "877-777-7777", "email@email.com" );
    // Events::addEvent("Event 3", "Location 3", date ("Y-m-d H:i:s",  strtotime('2019-03-06T13:30:00')),date ("Y-m-d H:i:s",  strtotime('2019-03-06T14:30:00')),"Test Description 3", "https://buffalo.edu", "$60.00", "877-777-7777", "email@email.com" );
    // Events::addEvent("Event 4", "Location 4", date ("Y-m-d H:i:s",  strtotime('2019-03-06T09:30:00')),date ("Y-m-d H:i:s",  strtotime('2019-03-06T13:30:00')),"Test Description 4", "https://google.com", "$150.00", "877-777-7777", "email@email.com" );
    // Events::addEvent("Event 5", "Location 5", date ("Y-m-d H:i:s",  strtotime('2019-03-06')),date ("Y-m-d H:i:s",  strtotime('2019-03-06')),"Test Description 5", "https://google.com", "$250.00", "877-777-7777", "email@email.com" );
    // Events::addEvent("Event 6", "Location 6", date ("Y-m-d H:i:s",  strtotime('2019-03-06')),date ("Y-m-d H:i:s",  strtotime('2019-03-06')),"Test Description 6", "https://example.com", "$5.00", "877-777-7777", "email@email.com" );
    // Events::addEvent("Event 7", "Location 7", date ("Y-m-d H:i:s",  strtotime('2019-03-15T13:30:00')),date ("Y-m-d H:i:s",  strtotime('2019-03-06T14:30:00')),"Test Description 7", "https://example.com", "$5.00", "877-777-7777", "email@email.com" );
    // Events::addEvent("Event 8", "Location 8", date ("Y-m-d H:i:s",  strtotime('2019-03-28T09:30:00')),date ("Y-m-d H:i:s",  strtotime('2019-03-06T13:30:00')),"Test Description 8", "https://example.com", "$5.00", "877-777-7777", "email@email.com" );
    // Events::addEvent("Event 9", "Location 9", date ("Y-m-d H:i:s",  strtotime('2019-03-15T13:30:00')),date ("Y-m-d H:i:s",  strtotime('2019-03-06T14:30:00')),"Test Description 9", "https://example.com", "$75.00", "877-777-7777", "email@email.com" );
   
    $result = Events::getAll();
    $formattedResults = array();
    if($result == NULL){
        http_response_code(400);
        die();
    } 

    foreach ($result as $value) {
        $formattedResults[] = array('title' => $value['NAME'], 'start' => $value['START_TIME'], 'end' => $value['END_TIME']);
    }

    

    echo json_encode($formattedResults);
?>