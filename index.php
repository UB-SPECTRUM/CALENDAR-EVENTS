<?php 
    require_once "Models/EventCategories.php";

    $categories = EventCategories::getAll();

?>



<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php include('head-tags.php') ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.css">
    <link rel="stylesheet" href="eventCalendar.css">
    
    <script src="tagify.min.js"></script>
    <link rel="stylesheet" href="tagify.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="eventCalendar.js"></script>
    <title>Events Calendar</title>
</head>

<body>
<?php include('navbar-bootstrap.php')?>
<script>
    var categories;
    categories = [
        <?php 
        foreach ($categories as $value) {
            $label = $value['NAME'];
            $icon = $value['ICON'];
            $description = $value['DESCRIPTION'];
            $categoryId = $value['CATEGORY_ID'];
            echo "{label: '$label', icon: '$icon',description:'$description',value: '$categoryId', disabled: false },";
        }    
        ?>
    ];
    
    var categoryIconMapping = {
        <?php 
        foreach ($categories as $value) {
            $label = $value['NAME'];
            $icon = $value['ICON'];
            $description = $value['DESCRIPTION'];
            $categoryId = $value['CATEGORY_ID'];
            echo " '$categoryId':'$icon',";
        }    
        ?>
    };
</script>
    <div class="container-fluid" style="padding:10px">
    <div class="row">
        <div class="col-12" id="notification-section">
            
        </div>
    </div>
        <div class="row">
            <div class="col">

                <div class="row mb-3">
                    <div class="col">
                        <button class="btn btn-secondary" id="toggleFiltersButton">Show Filters</button>
                    </div>
                </div> 
                <div class="row mb-3" id="filterSection" style="display: none;">
                    <div class="col-xs-12 col-md-4">
                        <h5>By Category</h5>
                        <div class="dropdown">
                            <div class="row">
                                <div class="col-xs-6 col-md-4">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Categories
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="category-menu">

                                    </div>
                                </div>
                                <div class="col">
                                    <input name='tags-outside' class='tagify--outside' style="display: none;" >
                                    <input type="hidden" name="categories" id="categories"/>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-xs-12 col-md-4">
                        <h5>By Time</h5>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <label>After</label>
                                <div class="input-group date" data-target-input="nearest">
                                    <input type="text" class="form-control" id="filterAfter" style="width: 80%" />
                                    <div class="input-group-append" data-target="#filterAfter" data-toggle="datetimepicker">
                                            <div class="input-group-text clear-button" onclick="clearSiblingInput(this);"  ><i class="fa fa-times"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label>Before</label>
                                <div class="input-group date"  data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"id="filterBefore" style="width: 80%" />
                                    <div class="input-group-append" data-target="#filterBefore" data-toggle="datetimepicker">
                                            <div class="input-group-text clear-button" onclick="clearSiblingInput(this);"><i class="fa fa-times"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <h5>By Cost</h5>
                        
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col">
                <div id='calendar' style="height: 90vh;"></div>
            </div>
        </div>
    </div>
    <?php include('footer-bootstrap.php') ?>
</body>

</html>