<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
  <title>{{__('common.'.$title)}}</title>
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

    body {
      font-family: 'Droid Serif', sans-serif !important;
    }
  </style>
</head>
<body>