@extends('front-end.layout.master')
@section('content')
    <div class="content">
        @php
            $title = Helper::getContentByLang('title');
            $description = Helper::getContentByLang('description');
        @endphp
        <div class="container">
            @if ($visionMissions && $visionMissions->count())
                <div class="row vision-mission">
                    @foreach ($visionMissions as $visionMission)
                        <div class="col-sm-6 d-flex col-12 mb-5 align-items-center justify-content-center px-5">
                            <div>
                                <h1 class="text-white text-uppercase fw-bold fs-1 mb-3" style="white-space: nowrap;">
                                    {{ $visionMission->$title }}
                                </h1>
                                <div class="text-white break-word lh-lg fs-5">{!! trim($visionMission->$description) !!}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    @push('footerScript')
        var visionMissionHeight = $(".vision-mission").height();
        var spaceHeight = contentHeight - visionMissionHeight;
        var shouldMarginTop = spaceHeight / 2;
        $(".vision-mission").css("margin-top", shouldMarginTop);
    @endpush
@endsection
