@extends('front-end.layout.master')
@section('content')
    @if (isset($contactUs))
        <?php
        $locale = app()->getLocale();
        $title = 'title_' . $locale;
        $address = 'address_' . $locale;
        ?>
        <div class="contact-us">
            <div class="text-uppercase fw-bold fs-1 text-white">
                <div class="container">
                    <div class="px-2" style="margin-top: 1.7rem;margin-bottom: 1rem;">
                        <h1 class="fs-1">{{ $contactUs->$title }}</h1>
                    </div>
                </div>
                <div class="text-center">
                    <img src="{{ $contactUs->photo }}" alt="" class="mt-2" style="max-width:100%;">
                </div>

            </div>
            <div class="container py-5">
                <div class="row">
                    <div class="col-sm-6 col-12 mb-3 font-siemreap">
                        <div class="fs-6 text-white">
                            {!! $contactUs->$address !!}
                        </div>
                    </div>
                    <div class="col-sm-6 col-12 d-flex justify-content-end mb-3">
                        <ul class="list-inline">
                        {{dd($socials)}}
                            @if (isset($socials) && count($socials))
                                @foreach ($socials as $social)
                                <li class="list-inline-item">
                                    <a href="{{ $social->link }}" target="_blank">
                                        <img src="{{ $social->icon }}" alt=""
                                            style="width: 40px;">
                                    </a>
                                </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
