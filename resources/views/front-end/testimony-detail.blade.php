@extends('front-end.layout.master')
@section('content')
    <div>
        <?php
        $title = Helper::getContentByLang('title');
        $description = Helper::getContentByLang('description');
        ?>
        <div class="container">
            @if (isset($testimony))
                <div class="row justify-content-center py-5">
                    <div class="col-md-6 col-12">
                        <div class="card testimonial-card rounded-base">
                            <div class="card-body">
                                <h3 class="mb-3">{{ $testimony->$title }}</h3>
                                <div class="d-flex align-items-center">
                                    <video width="100%" controls poster="{{ $testimony->photo }}">
                                        <source src="{{ $testimony->video }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>

                            </div>
                            <div class="card-footer">
                                <p class="card-text">"{{ $testimony->$description }}"</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
