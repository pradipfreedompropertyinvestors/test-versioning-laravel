<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Call Center CRM') }}</title>

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        @include('partials.css')

    </head>
    <body class="font-sans antialiased">
        <div id="layout-wrapper">
            <div class="header-border"></div>
            @include('partials.header')
            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">
                <div data-simplebar class="h-100">
                    <div class="navbar-brand-box">
                        <a href="index.html" class="logo">
                         <img src="assets/images/kshema-logo-black.png" alt="Generic placeholder image" width="120px">
                        </a>
                    </div>
                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        @include('partials.sidebar')
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->

            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    {{ $slot }}
                </div>
                <!-- End Page-content -->

                @include('partials.footer')

            </div>
            <!-- end main content-->

        </div>
        @include('partials.js')
    </body>
</html>
