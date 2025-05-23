<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@yield( 'title', config( 'app.name' ) ) - {{ config( 'app.name' ) }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset( 'assets/img/favicon.ico' ) }}"/>
    <link href="{{ asset( 'layouts/css/light/loader.css' ) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset( 'layouts/css/dark/loader.css' ) }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset( 'layouts/loader.js' ) }}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset( 'bootstrap/css/bootstrap.min.css' ) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset( 'layouts/css/light/plugins.css' ) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset( 'layouts/css/dark/plugins.css' ) }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        baseUrl = "{{ config( 'app.url' ) }}";
    </script>

    @stack('styles')
</head>