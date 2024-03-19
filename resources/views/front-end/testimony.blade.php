@extends('front-end.layout.master')
@section('content')
    <div class="who-we-are w-100 h-100">
        <?php
        $title = Helper::getContentByLang('title');
        $description = Helper::getContentByLang('description');
        ?>
        <div class="container">
            @if ($testimonies && $testimonies->count())
                <div class="py-5 text-center mb-5">
                    <h1 class="text-white text-uppercase fw-bold fs-1">{{ __('common.Our Testimonies') }}</h1>
                </div>
                <div class="row">
                    @foreach ($testimonies as $testimony)
                        <div class="col-sm-6 col-12 col-md-3 col box">
                            <a href="/testimonies/{{ $testimony->id }}/detail" class="text-decoration-none"
                                style="color: black;">
                                <div class="box rounded-lg shadow-bottom position-relative testimony">
                                    <div class="position-absolute wrapper-testimony">
                                        <div class="testimony-image shadow-circle"
                                            style="background-image: url({{ $testimony->photo }});background-size: cover;">
                                        </div>
                                    </div>
                                    <div class="bg-white p-3 rounded-lg text-center">
                                        <div>
                                            <h2 class="fw-bold fs-4 mt-5">{{ $testimony->$title }}</h2>
                                        </div>
                                        <div>
                                            <p>{{ Helper::limitString(strip_tags($testimony->$description), 150) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="py-5 d-flex justify-content-end">
                    <div class="d-flex justify-content-end clearfix">
                        @if (request()->get('page_size') != null)
                            @php
                                $pageSize = request()->get('page_size');
                                $viewMore = $pageSize + 4;
                            @endphp
                            <p>
                                <a href="/testimonies?page_size={{ $viewMore }}"
                                    class="text-white text-decoration-none">View
                                    More -></a>
                            </p>
                        @else
                            <p>
                                <a href="/testimonies?page_size=4" class="text-white text-decoration-none">View
                                    More -></a>
                            </p>
                        @endif

                    </div>
                </div>
            @endif
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var colums = $('.col');
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

@push('style')
    <style>
        .testimony:hover {
            transform: scale(1.1);
            transition: all 0.5s;

        }
    </style>
@endpush
