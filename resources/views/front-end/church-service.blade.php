@extends('front-end.layout.master')
@section('content')
<div class="who-we-are w-100 h-100 d-flex justify-content-center align-items-center">
    @php
    $title = Helper::getContentByLang('title');
    $description = Helper::getContentByLang('description');
    @endphp
    <div class="container">
        @if($churchServce && $churchServce)
        <div class="row">
            <div class="col-sm-6">
                <div>
                    <h1 class="text-white text-uppercase fw-bold fs-1" style="white-space: nowrap;">
                        {{$churchServce->$title}}
                    </h1>
                    <br />
                    <img src="{{$churchServce->photo}}" class="rounded-lg img-fluid" id="main_image" data-url="{{$churchServce->photo}}" />
                </div>
            </div>
            <div class="col-sm-1"></div>
            <div class="col-sm-5">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-white fs-4 py-4 pb-5">{{ __('common.Time') }}</th>
                            <th class="text-white fs-5 py-4 pb-5">{{ __('common.Session') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(json_decode($churchServce->timetables) as $key => $value)
                        <tr data-image="{{$value->image}}" class="session" style="cursor:pointer">
                            <td class="text-white fs-6 py-4 pb-5">{{ $value->time }}</td>
                            <td class="text-white fs-6 py-4 pb-5">{{ $value->session }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>
<script src="{{asset('dist/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $(".session").click(function() {
            var image = $(this).data('image');
            $("#main_image").attr('src', image);
        })

        $("table").mouseleave(function() {
            var image = $("#main_image").data('url');
            $("#main_image").attr('src', image);
        })
    })
</script>
@endsection