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
                        <div class="w3-content w3-display-container">
                            <img class="services rounded-base" src="{{ $churchServce->photo }}" style="max-width:100%;">
                            @foreach (json_decode($churchServce->timetables) as $key => $value)
                                <img class="services rounded-base" src="{{ $value->image }}" style="max-width:100%">
                            @endforeach

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
                                    <tr data-image="{{ $value->image }}" class="session"
                                        data-index="{{ $key }}">
                                        <td class="text-white fs-6 text-center" style="padding:2.25rem 0rem;">
                                            {{ $value->time }}</td>
                                        <td class="text-white fs-6 text-center" style="padding:2.25rem 0rem;">
                                            {{ $value->session }}</td>
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
        var activeIndex = 0;
        showService(activeIndex);

        function showService(index) {
            var x = document.getElementsByClassName("services");

            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }

            x[index].style.display = "block";
        }
        $(document).ready(function() {
            $(".session").on('mouseover', function() {
                var index = $(this).data("index");
                showService(index + 1);
            });

            $("table").on('mouseleave', function() {
                showService(0);
            })
        });
    </script>
@endsection
