<?php
    header('content-type: application/json; charset=utf-8');
    // header("access-control-allow-origin: *");

    require_once "Models/Events.php";
    require_once "Models/EventCategories.php";

   
    $start = (isset($_POST['start']) && !empty($_POST['start'])) ? $_POST['start'] : '';
    $end = (isset($_POST['end']) && !empty($_POST['end'])) ? $_POST['end'] : '';

    $after = (isset($_POST['after']) && !empty($_POST['after'])) ? $_POST['after'] : '';
    $before = (isset($_POST['before']) && !empty($_POST['before'])) ? $_POST['before'] : '';
    $categories = (isset($_POST['categories']) && !empty($_POST['categories'])) ? $_POST['categories'] : '';
    $categories = htmlentities($categories);
    $after = htmlentities($after);
    $before = htmlentities($before);
    
    try {
        $result = Events::getAll($after,$before,$categories);
        $formattedResults = array();
        
    
        foreach ($result as $value) {
            $categories = EventCategories::getCategoriesForEvent($value['ID']);
            $formattedResults[] = array('title' => $value['NAME'], 'start' => $value['START_TIME'], 'end' => $value['END_TIME'], 'description' => $value['DESCRIPTION'], 'id' => $value['ID'], 'categories'=> $categories);
        }
    
        echo json_encode($formattedResults);
    } catch (\Throwable $th) {
        http_response_code(400);
        die();
    }
    
?>