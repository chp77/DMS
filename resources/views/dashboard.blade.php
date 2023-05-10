<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Head -->
    @include('Template.head')
    <title>Dashboard | DMS</title>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper" id="app">
        <!-- Navbar -->
        @include('Template.navbar')

        <!-- Main Sidebar Container -->
        @include('Template.left-sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <router-view></router-view>
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
