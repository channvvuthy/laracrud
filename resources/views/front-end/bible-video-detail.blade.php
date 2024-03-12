@extends('front-end.layout.master')
@section('content')
<div class="who-we-are w-100 h-100">
    <?php
        $title = Helper::getContentByLang('title');
        $caption = Helper::getContentByLang('caption');
        ?>
    <div class="container py-5">
        @if (isset($bibleStudy))
        <div class="bg-white rounded-lg" style="margin:auto; max-width:800px;">
            dlfnso
        </div>
        @endif
    </div>
</div>
@endsection
