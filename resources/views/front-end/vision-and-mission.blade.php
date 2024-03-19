@extends('front-end.layout.master')
@section('content')
    <div class="content">
        @php
            $title = Helper::getContentByLang('title');
            $description = Helper::getContentByLang('description');
        @endphp
        <div class="container py-5">
            @if ($visionMissions && $visionMissions->count())
                <div class="row vision-mission">
                    @foreach ($visionMissions as $visionMission)
                        <div class="col-sm-6 d-flex col-12 mb-5 align-items-center justify-content-center px-5">
                            <div>
                                <h1 class="text-white text-uppercase fw-bold fs-1 mb-3" style="white-space: nowrap;">
                                    {{ $visionMission->$title }}
                                </h1>
                                <div class="text-white break-word lh-lg fs-5">
                                    <p>{!! trim($visionMission->$description) !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
