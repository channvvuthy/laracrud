<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('dist/js/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <title>
        @if (isset($siteTitle))
            {{ __('common.' . $siteTitle) }}
        @else
            Eternity Community church
        @endif
    </title>
    <style>
        @font-face {
            font-family: 'Droid Serif';
            src: url("{{ asset('fonts/DroidSerif-Regular.ttf') }}") format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Droid Serif';
            src: url("{{ asset('fonts/DroidSerif-Bold.ttf') }}") format('truetype');
            font-weight: bold;
            font-style: normal;
        }

        @font-face {
            font-family: 'Koulen';
            src: url("{{ asset('fonts/Koulen-Regular.ttf') }}") format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'innovate';
            src: url("{{ asset('fonts/innovate-regular.otf') }}") format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'siemreap';
            src: url("{{ asset('fonts/Siemreap-Regular.ttf') }}") format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'siemreap', Droid Serif', Koulen, sans-serif !important;

        }

        .f-koulen {
            font-family: 'Koulen' !important;
        }

        .font-siemreap {
            font-family: innovate, 'siemreap' !important;
        }

        .documents {
            border-left: 1px solid #236DA3;
        }

        .border-b {
            border-bottom: 1px solid #236DA3;
        }

        .thumbnail {
            max-width: 40%;
        }

        .bg-overlay {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .icon-play {
            width: 40px;
        }

        .rounded-base {
            border-radius: 1rem;
        }

        .rounded-top-base {
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
        }
        .nav-item a{
            font-family: 'Droid Serif', 'siemreap' !important;
        }
    </style>
    @stack('style')
</head>

<body>
