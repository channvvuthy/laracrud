@extends('front-end.layout.master')
@section('content')
<div class="who-we-are w-100 h-100 d-flex justify-content-center align-items-center">
    @php
    $title = Helper::getContentByLang('title');
    $description = Helper::getContentByLang('description');
    @endphp
    <div class="container">
        @if($visionMissions && $visionMissions->count())
        <div class="row">
            @foreach($visionMissions as $visionMission)
            <div class="col-sm-6 d-flex justify-content-center align-items-center">
                <div>
                    <h1 class="text-white text-uppercase fw-bold fs-1" style="white-space: nowrap;">
                        {{$visionMission->$title}}
                    </h1>
                    <br />
                    <div class="text-white break-word lh-lg fs-5">{!! trim($visionMission->$description) !!}</div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection