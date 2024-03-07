@extends('front-end.layout.master')
@section('content')
<div class="who-we-are w-100 h-100 d-flex justify-content-center align-items-center">
    <?php
        $title = Helper::getContentByLang('title');
        $description = Helper::getContentByLang('description');
    ?>
    @if($whoWeAre)
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="text-white text-uppercase fw-bold fs-1" style="white-space: nowrap;">
                        {{$whoWeAre->$title}}
                    </h1>
                    <br />
                    <img src="{{$whoWeAre->photo}}" alt="" class="rounded-lg img-fluid">
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-5 text-white break-word lh-lg fs-5">
                    {!! trim($whoWeAre->$description) !!}

                </div>
            </div>
        </div>
    @endif
</div>
@endsection