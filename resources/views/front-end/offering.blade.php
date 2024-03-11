@extends('front-end.layout.master')
@section('content')
@if(isset($offering))
<?php
$locale = app()->getLocale();
$title = "title_" . $locale;
$description = "description_" . $locale;
$wayToGive = "way_to_give_" . $locale;
?>
?>
<div class="container">
    <div class="offering py-5">
        <div class="text-uppercase fw-bold fs-1 text-white">
            <div class="px-2 py-3">
                <h1 class="fs-1">{{$offering->$title}}</h1>
            </div>
        </div>
        <div class="text-white">
            {!!$offering->$description!!}
        </div>
        <div class="text-white py-3">
            <h1 class="fs-1">{!!$offering->$wayToGive!!}</h1>
        </div>
    </div>
</div>
@endif
@endsection