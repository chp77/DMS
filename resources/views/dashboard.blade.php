<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Head -->
    @include('Template.head')
    <title>Asset Management System | AMS</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <!-- <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css"> -->
    <!-- <link rel="stylesheet" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" /> -->
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.6/dist/vue-multiselect.min.css">
    <!-- <link rel="stylesheet" href="{{asset('css/intlTelInput.css')}}"> -->
    <link rel="stylesheet" href="https://cdn.tutorialjinni.com/intl-tel-input/17.0.8/css/intlTelInput.css"/>
    <!-- <script src="https://cdn.tutorialjinni.com/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script> -->


    <!-- <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" /> -->
    <!-- <link rel="stylesheet" href="https://dms.edmdigital.online/css/datetimepicker.css" /> -->
    <!-- <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/daterangepicker/daterangepicker.css" /> -->


    <!-- <link rel="stylesheet" href="https://dms.edmdigital.online/css/bootstrap.min.css" /> -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css"> -->
</head>

    <body class="hold-transition sidebar-mini">
        <div class="wrapper" id="app">
            <div class="screen" style="display: none;">
                <div class="retrieving">
                    <label class="text-white progress-label">Bulk importing the asset data </label>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                </div>
            </div>
            <!-- Navbar -->
            @include('Template.navbar')

            <!-- Main Sidebar Container -->
            @include('Template.left-sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Main content -->
                <div class="content">
                    <router-view user="{{ json_encode($user) }}"></router-view>
                    <vue-progress-bar></vue-progress-bar>
                </div>
            </div>

            <!-- Main Footer -->
            @include('Template.footer')
        </div>

        <!-- jQuery -->
        @include('Template.script')

    </body>
</html>

<style>
    .fa-phone, .fa-envelope {
        padding-right: 5px;
    }
    .call, .email {
        text-decoration: none;
        margin: 10px;
    }
    .grey-text {
        color: grey;
        opacity: 0.8;
    }
    .top-bar {
        align-items: stretch;
        background-color: #e1e1e1;
        flex-direction: row-reverse;
        border-top-left-radius: 0.3rem;
        border-top-right-radius: 0.3rem;
    }
    .transparent-logo {
        width: 40px;
        z-index: 1;
    }
    .expired-timer {
        width: 50px;
        margin-bottom: 20px;
    }
    .text-center {
        flex-direction: column-reverse;
        padding-bottom: 30px;
        background-color: #e1e1e1;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        margin-top: -30px;
    }
    .expired-title {
        font-weight: bolder;
    }
    .screen {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgb(0 0 0 / 83%);
        display: none;
        align-items: center;
        z-index: 100000;
        justify-content: space-around;
    }

    .retriving {
        width: 100%;
        height: 15px;
        text-align: center;
    }

    .dot {
        position: relative;
        width: 15px;
        height: 15px;
        margin: 0 2px;
        display: inline-block;
    }

    .dot:first-child:before {
        animation-delay: 0ms;
    }

    .dot:first-child:after {
        animation-delay: 0ms;
    }

    .dot:nth-child(2):before {
        animation-delay: 100ms;
    }

    .dot:nth-child(2):after {
        animation-delay: 100ms;
    }

    .dot:last-child:before {
        animation-delay: 200ms;
    }

    .dot:last-child:after {
        animation-delay: 200ms;
    }

    .dot:before{
        content: "";
        position: absolute;
        left: 0;
        width: 15px;
        height: 15px;
        background-color: blue;
        animation-name: dotHover;
        animation-duration: 900ms;
        animation-timing-function: cubic-bezier(.82,0,.26,1);
        animation-iteration-count: infinite;
        animation-delay: 100ms;
        background: white;
        border-radius: 100%;  
    }

    .dot:after {
        content: "";
        position: absolute;
        z-index: -1;
        background: black;
        box-shadow: 0px 0px 1px black;
        opacity: .20;
        width: 100%;
        height: 3px;
        left: 0;
        bottom: -2px;
        border-radius: 100%;
        animation-name: dotShadow;
        animation-duration: 900ms;
        animation-timing-function: cubic-bezier(.82,0,.26,1);
        animation-iteration-count: infinite;
        animation-delay: 100ms;
    }

    @keyframes dotShadow {
        0% {
            transform: scaleX(1);
        }
        50% {
            opacity: 0;
            transform: scaleX(.6);
        }
        100% {
            transform: scaleX(1);
        }
        }

        @keyframes dotHover {
        0% {
            top: 0px;
        }
        50% {
            top: -50px;
            transform: scale(1.1);
        }
        100% {
            top: 0;
        }
    }

    .text-white {
        color: white;
        font-size: 33px;
        margin-right: 20px;
    }
</style>