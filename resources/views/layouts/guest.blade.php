<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Call Center CRM') }}</title>

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/kshema-logo-black.png') }}">

        <!-- App css -->
        @include('partials.css')
        
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center min-vh-100">
                        <div class="w-100 d-block bg-white shadow-lg rounded my-5">
                            <div class="row">
                                <div class="col-lg-5 d-none d-lg-block bg-login rounded-left"></div>
                                <div class="col-lg-7">
                                    <div class="p-5">
                                        <!-- <div class="text-center mb-5">
                                            <a href="javascript:void(0);" class="text-dark font-size-22 font-family-secondary">
                                                <i class="mdi mdi-alpha-x-circle"></i> <b>KARMA</b>
                                            </a>
                                        </div> -->
                                        <div class="text-center">
                                            <img src="{{ asset('assets/images/kshema-logo-black.png') }}" alt="Generic placeholder image">
                                        </div>
                                        <h1 class="h5 mb-1">&nbsp;</h1>
                                        <p class="text-muted mb-4">&nbsp;</p>
                                        {{ $slot }}
                                        <!-- end row -->
                                    </div> <!-- end .padding-5 -->
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                        </div> <!-- end .w-100 -->
                    </div> <!-- end .d-flex -->
                </div> <!-- end col-->
            </div> <!-- end row -->
        </div>
        @include('partials.js')
    </body>
</html>
