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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
    <script src="eventCalendar.js"></script>
    <title>Events Calendar</title>
</head>

<body>
<?php include('navbar-bootstrap.php')?>

    <div class="container-fluid" style="padding:10px">
        <div class="row">
            <div class="col">

                <!-- <div class="row mb-3">
                    <div class="col">
                        <button class="btn btn-secondary" id="toggleFiltersButton">Show Filters</button>
                    </div>
                </div> -->
                <div class="row mb-3" id="filterSection" style="display: none;">
                    <div class="col-xs-12 col-md-6">
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
                                    <input name='tags-outside' class='tagify--outside' style="display: none;">
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-xs-12 col-md-6">
                        <h5>By Time</h5>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <label>After</label>
                                <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" />
                                    <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                            <div class="input-group-text clear-button" onclick="clearSiblingInput(this);"><i class="fa fa-times"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label>Before</label>
                                <div class="input-group date" id="datetimepickerBefore" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerBefore" />
                                    <div class="input-group-append" data-target="#datetimepickerBefore" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                            <div class="input-group-text clear-button" onclick="clearSiblingInput(this);"><i class="fa fa-times"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
</body>

</html>