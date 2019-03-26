<?php 
    $eventId = $_GET['eventId'];
    $eventId = htmlentities($eventId);

    require_once "Models/EventCategories.php";

    $categories = EventCategories::getCategoriesForEvent($eventId);

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include('head-tags.php') ?>
    <script src="/ubspectrum/pdfjs/build/pdf.js"></script>

    <script src="/ubspectrum/pdfThumbnails.js"></script>

    <title>Event Information</title>
</head>
<body class="container-fluid">
<?php include('navbar-bootstrap.php')?>

    <div class="row">
        <div class="col-3 text-center" style="margin: 0 auto;">
            <h1>Event <?php echo $eventId ?>Info</h1>
            <?php 
            
                foreach ($categories as $value) {
                    $id = $value['CATEGORY_ID'];
                    $name = $value['NAME'];
                   echo "$id - $name";
                }
            ?>
            <img data-pdf-thumbnail-file="/ubspectrum/events/downloadEventFlyer.php?eventId=<?php echo $eventId ?>">
        </div>
    </div>
<?php include('footer-bootstrap.php') ?>

</body>
</html>