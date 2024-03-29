@extends('front-end.layout.master')
@section('content')
    <div class="who-we-are w-100 h-100">
        <?php
        $title = Helper::getContentByLang('title');
        $caption = Helper::getContentByLang('caption');
        $description = Helper::getContentByLang('description');
        ?>
        <div class="container py-5">
            @if (isset($bibleStudy))
                <div class="row">
                    <div class="col-md-7 px-5 mb-3">
                        <?php $index = request()->get('index'); ?>
                        @if ($index != null)
                            @php
                                $activeLibrary = $libraries[$index];
                            @endphp
                            @if ($activeLibrary->file)
                                <img src="{{$activeLibrary->thumbnail}}" style="max-width:100%" class="rounded-base mb-3"/>
                                <audio controls class="w-100" autoplay="true">
                                    <source src="{{ $activeLibrary->file }}" type="audio/mpeg">
                                </audio>
                                <h4 class="text-white mt-2">{{ $activeLibrary->$title }}</h4>
                                <p class="text-white">{{ $activeLibrary->$description }}</p>
                            @else
                                <iframe width="100%" height="415"
                                    src="https://www.youtube.com/embed/{{ explode('=', $activeLibrary->url)[1] }}"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe>
                                <h4 class="text-white mt-2">{{ $activeLibrary->$title }}</h4>
                                <p class="text-white">{{ $activeLibrary->$description }}</p>
                            @endif
                        @else
                            @include('front-end.partial.bible-audio-single')
                        @endif
                    </div>
                    <div class="col-md-5 documents px-5">
                        <h1 class="text-white fw-bold fs-1 mb-4">{{ __('common.Audios') }}</h1>
                        <ul class="list-unstyled" id="playlist" style="overflow-y: scroll;">
                            @include('front-end.partial.bible-audio-list')
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        var windowHeight = $(window).height();
        var navbarHeight = $('.navbar').height();
        var playlistHeight = windowHeight - navbarHeight;
        $('#playlist').height(playlistHeight);
    })

</script>
@endpush
