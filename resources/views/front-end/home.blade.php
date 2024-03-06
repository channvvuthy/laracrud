@extends('front-end.layout.master')
@section('content')
@isset($welcome)
@php
$locale = app()->getLocale();
$displayName = "caption_" . $locale;
@endphp
<div class="banner position-relative">
  <img src="{{$welcome->photo}}" class="img-fluid"/>
  <div class="caption position-absolute top-0 end-0 bg-light">
    <h1>
      {{$welcome->$displayName}}
    </h1>
  </div>
</div>
@endisset
@endsection