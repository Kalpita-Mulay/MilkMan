<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo BASE_PATH; ?>assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="<?php echo BASE_PATH; ?>assets/img/favicon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>
            Delybites
        </title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <!-- CSS Files -->
        <link href="<?php echo BASE_PATH; ?>assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="<?php echo BASE_PATH; ?>assets/css/material-dashboard.min.css?v=2.1.0" rel="stylesheet" />
        <script src="<?php echo BASE_PATH; ?>assets/js/jquery-2.1.1.min.js" type="text/javascript"></script>
    </head>
    <style>
        .vcenter {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        span {
            cursor: pointer;
        }

        .minus,
        .plus {
            width: 20px;
            background: #f2f2f2;
            border-radius: 4px;
            display: inline-block;
            vertical-align: middle;
            text-align: center;
        }

        .input_count {
            width: 18%;
            text-align: center;
            font-size: 26px;
            vertical-align: middle;
            border: 0;
        }


        .input_material {
            font-size: 18px;
            border: none;
            border-bottom: 1px solid #757575;
        }

        .input_material:focus {
            outline: none;
        }

        /* LABEL ======================================= */
        label {
            color: #999;
            font-size: 18px;
            font-weight: normal;
            pointer-events: none;
            left: 5px;
            top: 10px;
            transition: 0.2s ease all;
            -moz-transition: 0.2s ease all;
            -webkit-transition: 0.2s ease all;
        }

        /* active state */
        .input_material:focus~label,
        .input_material:valid~label {
            top: -20px;
            font-size: 14px;
            color: gray;
        }

        .h6, h6 {
            font-size: 18px;
            text-transform: capitalize;
            font-weight: 500;
            color: gray;

        }

        .tab{
            max-width: 25%;
        }

        .button{
            padding: 0px 15px;
            border-radius: 20px;
            height: 41px;
            color:black;
            border: 1px solid black;
            background-color: white;
        }

        .day_button{
            padding: 0px 15px;
            border-radius: 20px;
            height: 41px;
            color:black;
            border: 1px solid #ffcf00;
            background-color: #ffcf00;
            width: 100%;
        }
        .btn:hover, .btn:focus, .btn:not(:disabled):not(.disabled):active, .btn:not(:disabled):not(.disabled).active, .btn:not(:disabled):not(.disabled):active:focus, .btn:not(:disabled):not(.disabled).active:focus, .btn:active:hover, .btn.active:hover, .show > .btn.dropdown-toggle, .show > .btn.dropdown-toggle:focus, .show > .btn.dropdown-toggle:hover, .navbar .navbar-nav > a.btn:hover, .navbar .navbar-nav > a.btn:focus, .navbar .navbar-nav > a.btn:not(:disabled):not(.disabled):active, .navbar .navbar-nav > a.btn:not(:disabled):not(.disabled).active, .navbar .navbar-nav > a.btn:not(:disabled):not(.disabled):active:focus, .navbar .navbar-nav > a.btn:not(:disabled):not(.disabled).active:focus, .navbar .navbar-nav > a.btn:active:hover, .navbar .navbar-nav > a.btn.active:hover, .show > .navbar .navbar-nav > a.btn.dropdown-toggle, .show > .navbar .navbar-nav > a.btn.dropdown-toggle:focus, .show > .navbar .navbar-nav > a.btn.dropdown-toggle:hover {
            background-color: #ffcf00;
            color: black;
            box-shadow: none;
            border-color: #ffcf00;
        }

        .button_subscribe{
            border-radius: 20px;
            width: 30%;
            height: 41px;
            background-color: #ffcf00;
            color:black;
        }
        .box{
            width:100%;
            height:100px;
            border-radius: 10px;
        }

        .grey{
            background:rgba(211,211,211,0.5);
        }

        .flex-container {
            display: inline-flex;
            margin-top: 3%;
        }

        .flex-container > div {
            padding: 15px;
            font-size: 18px;
        }
        .box1{
            margin-left: 21px;
            background-color: #ffcf00;
            border-radius: 9px;
            height: 52px;
            color:white;
        }
        .box2{
            background-color: lightgrey;
            margin-left: -5px;
            height: 52px;
            border-top-right-radius: 9px;
            border-bottom-right-radius: 9px;
        }
        .box3{
            margin-left: 21px;
            background-color: black;
            border-radius: 9px;
            height: 52px;
            color:white;
        }
    </style>