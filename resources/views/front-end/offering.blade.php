@extends('front-end.layout.master')
@section('content')
    @if (isset($offering))
        <?php
        $locale = app()->getLocale();
        $title = 'title_' . $locale;
        $description = 'description_' . $locale;
        $wayToGive = 'way_to_give_' . $locale;
        ?>
        ?>
        <div class="container">
            <div class="offering py-5">
                <div class="text-uppercase fw-bold fs-1 text-white">
                    <div class="px-2 py-3">
                        <h1 class="fs-1">{{ $offering->$title }}</h1>
                    </div>
                </div>
                <div class="text-white">
                    {!! $offering->$description !!}
                </div>
                <div class="text-white mt-5">
                    <h1 class="fs-1">{!! $offering->$wayToGive !!}</h1>
                </div>
                <div class="rounded-lg bg-dark px-5 d-flex">
                    <div class="flex-grow-1 mt-5">
                        <h3 class="text-white">In Service</h3>
                        <p class="text-white" style="margin:0px;">
                            Please kindly bring your cash or check to our Sunday service.
                        </p>
                        <div>
                            <a href="" class="bg-white rounded-lg p-4">
                                <img src="{{asset('icons/paypal.png')}}"/>
                            </a>
                        </div>
                    </div>
                    <div style="width: 100px" class="d-flex justify-content-center items-center">
                        <div style="border-left:1px solid #4f5459;"></div>
                    </div>
                    <div class="flex-grow-1 mt-5">
                        <h3 class="text-white">Via Bank Account Below</h3>
                    </div>
                </div>
                <!-- <br>
                    <br>
                    <div class="text-white">
                        <h1 class="fs-1">{!! $offering->$wayToGive !!}</h1>
                    </div> -->
                <!-- <div class="row">
                        <div class="col-6 text-white">
                            <h3>In Service</h3>
                        </div>
                        <div class="col-6 text-white">
                            <h3>Via Bank Account Below</h3>
                        </div>
                    </div> -->
            </div>

        </div>
    @endif
@endsection
