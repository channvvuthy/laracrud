@extends('front-end.layout.master')
@section('content')
<div class="content">
    <?php
        $title = Helper::getContentByLang('title');
        $description = Helper::getContentByLang('description');
    ?>
    @if($whoWeAre)
        <div class="container">
            <div class="row pt-2">
                <div class="col-sm-6">
                    <h1 class="text-white text-uppercase fw-bold fs-1 py-4" style="white-space: nowrap;">
                        {{$whoWeAre->$title}}
                    </h1>
                    <img src="{{$whoWeAre->photo}}" alt="" class="rounded-base img-fluid">
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-5 text-white break-word lh-lg fs-5 py-4">
                    {!! trim($whoWeAre->$description) !!}

                </div>
            </div>
        </div>
    @endif
</div>
@endsection