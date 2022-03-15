<?php
/**
 * Created By: Amit Sarker
 * Created Date: 12-09-2020
 */
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    @section('title')
        {{getCompanyName() . ' | Admin'}}
    @endsection
    @include('admin.includes.head')
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    @include('admin.includes.topNav')
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        @include('admin.includes.sideNav')
    </div>
    <div id="layoutSidenav_content">
        <main id="mainContent">
            <div class="container-fluid">
                @yield('content')

{{--                @include('admin.dashboard.index')--}}
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            @include('admin.includes.footer')
        </footer>
    </div>
</div>
@include('admin.includes.script')
</body>
</html>
