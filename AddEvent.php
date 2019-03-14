<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include('head-tags.php') ?>

    <title>Add an Event</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
    <?php //include('navbar-bootstrap.php')?>
    <div class="container-fluid">
        <div class="row">
        <div class="col-3" style="margin: 0 auto;">
            <h1>Add an Event</h1>
            </div>
        </div>
        <form>
        <div class="row">
            <div class="col-xs-12 d-block d-md-none" >
                <label for="name">Name</label>

            </div>
            <div class="col-xs-12 col-md-4">
                <input type="text" name="name" id="name" class="form-control"/>
            </div>
        </div>
        </form>

    </div>
</body>
</html>