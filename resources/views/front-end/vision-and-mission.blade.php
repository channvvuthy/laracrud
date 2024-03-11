@extends('front-end.layout.master')
@section('content')
<div class="d-flex justify-content-center align-items-center content">
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
<script>
    $(document).ready(function() {
        function getWindowWidth() {
            var windowWidth = $(window).width();
            if(windowWidth < 991) {
                $(".content").removeClass('d-flex');
            }else{
                $(".content").addClass('d-flex');
            }
        }
        

        getWindowWidth();

        $(window).resize(function() {
            getWindowWidth();
        });
    });
</script>
@endsection