@extends('front-end.layout.master')
@section('content')
<div class="who-we-are w-100 h-100">
    <?php
    $title = Helper::getContentByLang('title');
    $caption = Helper::getContentByLang('caption');
    ?>
    <div class="container">
        @if($bibleStudies && $bibleStudies->count())
        <div class="py-5 text-center">
            <h1 class="text-white text-uppercase fw-bold fs-1">{{__('common.Bible Study')}}</h1>
        </div>
        <div class="row">
            @foreach($bibleStudies as $bibleStudy)

            <div class="col-sm-3">
                <a href="bible-studies?type=bible-audio&detail={{$bibleStudy->id}}" class="text-decoration-none" style="color: black;">
                    <div class="box rounded-lg shadow-bottom">
                        <div>
                            <img src="{{$bibleStudy->photo}}" class="rounded-top-lg img-fluid" id="main_image" data-url="{{$bibleStudy->photo}}" />
                        </div>
                        <div class="bg-white p-3 rounded-b-lg text-center">
                            <div class="fw-bold fs-4">{{$bibleStudy->$title}}</div>
                            <div>
                                {!!$bibleStudy->$caption!!}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="py-5 d-flex justify-content-end">
            <a href="" class="text-white">View More -></a>
        </div>

        @endif
    </div>
</div>
<script>
    $(document).ready(function() {
        var colums = $('.col-sm-3');
        var imageHeights = [];

        colums.each(function() {
            var imageHeight = $(this).height();
            imageHeights.push(imageHeight);
        })

        var maxHeight = Math.max.apply(null, imageHeights);
        colums.each(function() {
            $(this).find('.box').height(maxHeight);
            $(this).find('.box').addClass('bg-white');
        })
    })
</script>
@endsection