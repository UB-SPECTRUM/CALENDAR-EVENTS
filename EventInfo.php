<?php 
    $eventId = $_GET['eventId'];
    $eventId = htmlentities($eventId);

    require_once "Models/EventCategories.php";
    require_once "Models/Events.php";
    require_once "Models/EventContacts.php";

    $categories = EventCategories::getCategoriesForEvent($eventId);
    $eventInfo = Events::getEventInfo($eventId);
    $contacts = EventContacts::getAll($eventId);

    if($eventInfo['ID'] == '' or $eventInfo['APPROVAL_STATUS'] == 'delete'){
        http_response_code(400);
        die();
        exit();
    }
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include('head-tags.php') ?>
    <script src="/ubspectrum/javascript/pdfjs/build/pdf.js"></script>

    <script src="/ubspectrum/javascript/pdfThumbnails.js"></script>
    <script src="tagify.min.js"></script>
    <link rel="stylesheet" href="tagify.css">
    <title>Event Information</title>
</head>

<body class="container-fluid" style="font-size:16px;">
    <?php include('navbar-bootstrap.php')?>
    <div class="row">
        <div class="col-3" style="margin: 0 auto;">
            <h1 style="text-align:center;"><?php echo $eventInfo['NAME'];?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-xs-12 col-md-4" >
            <div class="row">
                <div class="col-xs-12">
                    
                    <input name='tags-outside' class='tagify--outside' style="display: none;" >

                    <script>
                    var categories = [
                            <?php 
                            foreach ($categories as $value) {
                                $label = $value['NAME'];
                                $icon = $value['ICON'];
                                $description = $value['DESCRIPTION'];
                                $categoryId = $value['CATEGORY_ID'];
                                echo "{label: '$label', icon: '$icon',description:'$description',value: '$categoryId' },";
                            }    
                            ?>
                        ];
                    $(document).ready(function(){
                        var input = document.querySelector('input[name=tags-outside]');
                        // init Tagify script on the above inputs
                        tagify = new Tagify(input, {
                            readonly: true,
                            tagTemplate : function(v, tagData){
                            return `<tag title='${tagData.label}'>
                                            <div>
                                                <i class="${tagData.icon}" ></i>&nbsp;
                                                <span class='tagify__tag-text'>${tagData.label}</span>
                                            </div>
                                        </tag>`;
                            },
                        });
                            // add a class to Tagify's input element
                            tagify.DOM.input.classList.add('tagify__input--outside');

                            // re-place Tagify's input element outside of the  element (tagify.DOM.scope), just before it
                            tagify.DOM.scope.parentNode.insertBefore(tagify.DOM.input, tagify.DOM.scope);

                            tagify.addTags(categories);
                        })
                    </script>
                </div>
            </div>
            <div class="row" >
                <div class="col-xs-12">
                    <p><?php echo $eventInfo['DESCRIPTION']; ?></p>
                </div>
            </div>
            <div class="row"  >
                <div class="col-xs-12 col-md-4">
                    <label for="name">Date</label>
                </div>
                <div class="col-xs-12 col-md-8">
                    <?php echo $eventInfo["DATE"] ?>
                </div>
            </div>
            <div class="row"  >
                <div class="col-xs-12 col-md-4">
                    <label for="name">Time</label>
                </div>
                <div class="col-xs-12 col-md-8">
                    <?php echo $eventInfo["START_TIME"] ?> - <?php echo $eventInfo["END_TIME"] ?>
                </div>
            </div>
            <div class="row"  >
                <div class="col-xs-12 col-md-4">
                    <label for="name">Location</label>
                </div>
                <div class="col-xs-12 col-md-8">
                    <?php echo $eventInfo["VENUE"] ?>
                </div>
            </div>
            <div class="row"  >
                <div class="col-xs-12 col-md-4">
                    <label for="name">UB Campus Location</label>
                </div>
                <div class="col-xs-12 col-md-8">
                    <?php 
                        switch ($eventInfo["UB_CAMPUS_LOCATION"]){
                            case 'north':
                                echo('North Campus');
                                break;
                            case 'south':
                                echo ('South Campus');
                                break;
                            case 'medical':
                                echo('Medical Campus');
                                break;
                            case 'off':
                                echo('Off Campus');
                                break;
                        }
                    ?>
                </div>
            </div>
            <div class="row"  >
                <div class="col-xs-12 col-md-4">
                    <label for="name">Cost</label>
                </div>
                <div class="col-xs-12 col-md-8">
                    <?php echo '$' . number_format($eventInfo["COST"], 2); ?>
                </div>
            </div>
            <div class="row"  >
                <div class="col-xs-12 col-md-4">
                    <label for="name">Link</label>
                </div>
                <div class="col-xs-12 col-md-8">
                    <a rel="noreferrer" href="<?php echo $eventInfo["LINK"] ?>"><?php echo $eventInfo["LINK"] ?></a>
                </div>
            </div>
            <div class="row"  >
                <div class="col-xs-12 col-md-4">
                    <label for="name">Contacts</label>
                </div>
                <div class="col-xs-12 col-md-8">
                    <?php 
                        foreach ($contacts as $contact) {
                            $name = $contact['PERSON_NAME'];
                            $info = $contact['ADDITIONAL_INFO'];
                            echo "$name - $info <br/><br/>";
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-4">
            <img data-pdf-thumbnail-file="/ubspectrum/events/downloadEventFlyer.php?eventId=<?php echo $eventId ?>">
        </div>
        <div class="col-md-2"></div>

    </div>
    
    </div>
    <?php include('footer-bootstrap.php') ?>

</body>

</html>