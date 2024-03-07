@extends('front-end.layout.master')
@section('content')
@isset($welcome)
@php
$locale = app()->getLocale();
$title = "title_" . $locale;
$caption = "caption_" . $locale;
@endphp
<div class="banner position-relative">
  <img src="{{$welcome->photo}}" class="img-fluid"/>
  <div class="d-flex justify-content-center align-items-center text-white position-absolute top-0 end-0 w-100 h-100 bg-black-rgba">
      <div class="px-2">
        <h1 class="fs-1">{{$welcome->$title}}</h1>
        <p class="fs-3">{{$welcome->$caption}}</p>
      </div>
  </div>
</div>
@endisset
@endsection