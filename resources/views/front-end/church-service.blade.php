@extends('front-end.layout.master')
@section('content')
    <div class="justify-content-center align-items-center">
        @php
            $title = Helper::getContentByLang('title');
            $description = Helper::getContentByLang('description');
        @endphp
        <div class="container py-5">
            @if ($churchServce && $churchServce)
                <div class="row">
                    <div class="col-sm-6 col-12 mb-5">
                        <h1 class="text-white text-uppercase fw-bold fs-1">
                            {{ $churchServce->$title }}
                        </h1>
                        <br />
                        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1" id="indicator-0"></button>
                                @foreach (json_decode($churchServce->timetables) as $key => $value)
                                    <button type="button" data-bs-target="#carouselExampleCaptions"
                                        id="indicator-{{ $key + 1 }}" data-bs-slide-to="{{ $key + 1 }}"
                                        aria-label="Slide {{ $key + 1 }}"></button>
                                @endforeach

                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="services rounded-base d-block w-100" src="{{ $churchServce->photo }}"
                                        style="max-width:100%;">
                                </div>
                                @foreach (json_decode($churchServce->timetables) as $key => $value)
                                    <div class="carousel-item">
                                        <img class="services rounded-base d-block w-100" src="{{ $value->image }}"
                                            style="max-width:100%">
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-5 col-12 mb-5">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-white fs-4 text-center" style="padding:2.25rem 0rem;">
                                        {{ __('common.Time') }}</th>
                                    <th class="text-white fs-5 text-center" style="padding:2.25rem 0rem;">
                                        {{ __('common.Session') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (json_decode($churchServce->timetables) as $key => $value)
                                    <tr data-image="{{ $value->image }}" class="session" data-index="{{ $key }}">
                                        <td class="text-white fs-6 text-center" style="padding:2.25rem 0rem;">
                                            <p>{{ Helper::showTime($value->time) }}</p>
                                        </td>
                                        <td class="text-white fs-6 text-center" style="padding:2.25rem 0rem;">
                                            <p>{{ $value->session }}</p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(".session").on('mouseover', function() {
                var index = $(this).data("index");
                $("#indicator-" + (index + 1)).click();
            });

            $("table").on('mouseleave', function() {
                $("#indicator-0").click();
            });

        });
    </script>
@endsection
@push('style')
    <style>
        td:hover {
            text-decoration: underline;
        }
    </style>
@endpush
