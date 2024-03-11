<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <script src="{{asset('dist/js/jquery.min.js')}}"></script>
  <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
  <title>
    @if(isset($siteTitle))
      {{__('common.'.$siteTitle)}}
    @else
      Eternity Community church 
    @endif
  </title>
  <style>
    @font-face {
      font-family: 'Droid Serif';
      src: url("{{asset('fonts/DroidSerif-Regular.ttf')}}") format('truetype');
      font-weight: normal;
      font-style: normal;
    }

    @font-face {
      font-family: 'Droid Serif';
      src: url("{{asset('fonts/DroidSerif-Bold.ttf')}}") format('truetype');
      font-weight: bold;
      font-style: normal;
    }
    @font-face {
      font-family: 'Koulen';
      src: url("{{asset('fonts/Koulen-Regular.ttf')}}") format('truetype');
      font-weight: normal;
      font-style: normal;
    }
    @font-face {
      font-family: 'innovate';
      src: url("{{asset('fonts/innovate-regular.otf')}}") format('truetype');
      font-weight: normal;
      font-style: normal;
    }

    body {
      font-family: 'Droid Serif', Koulen, sans-serif !important;
    }
  </style>
</head>
<body>