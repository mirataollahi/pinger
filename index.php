<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ping tools</title>
    <link rel="icon" type="image/x-icon" href="theme/favicon.png">
    <link href="theme/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="theme/style.css" rel="stylesheet">

</head>
<body>


<div class="container-fluid" style="padding: 35px;">

    <div class="justify-content-center text-center">
        <a class="btn b-warning"  href="/server?operation=reset" style="font-size: 20px">
            Reset
        </a>
    </div>

    <div class="main_section row justify-content-between">
        <div class="international_items col m-5 row">
            <!--  international items section-->
        </div>



        <div class="internal_items col m-5">
            <!--  international items section-->
        </div>
    </div>

</div>



<!--item template-->
<div id="template">
    <div class="item_server col-12 border item_border row justify-content-around mb-3 pt-4 pb-4 d-none"
         style="font-weight: bold;font-size: 22px;">
        <input type="hidden" name="server_address[]" class="server_address" value="https://tci.ir">
        <div class="col-6 text-center text-dark m-auto server_name">
            <span class="server_name_text">TCI</span>
            <span class="server_type" style="font-size: 15px !important;">(DNS)</span>
            <span class="server_average" style="font-size: 15px !important;"></span>
        </div>
        <div class="col text-center text-dark m-2 alert b-normal timing_section"
             style="font-size: 30px !important;">
            <span class="ping_time"><i class="fa fa-spinner fa-spin"></i></span>
            <span>ms</span>
        </div>
        <div class="col text-center text-dark m-2 alert b-normal lost_section"
             style="font-size: 30px !important;">
            <span class="ping_lost" ><i class="fa fa-spinner fa-spin"></i></span>
            <span>%</span>
        </div>
    </div>
</div>
<!-- end item template-->


<script src="theme/bootstrap.js"></script>
<script src="theme/jquery.js"></script>
<script src="theme/ping.js"></script>
</body>
</html>