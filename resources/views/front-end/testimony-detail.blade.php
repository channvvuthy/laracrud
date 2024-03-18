@extends('front-end.layout.master')
@section('content')
    <div class="py-3">
        <?php
        $title = Helper::getContentByLang('title');
        $description = Helper::getContentByLang('description');
        ?>
        <div class="container">
            @if (isset($testimony))
                <div class="row justify-content-center py-5">
                    <div class="col-md-8">
                        <div class="card testimonial-card">
                            <div class="card-body">
                                <h3 class="mb-3">{{ $testimony->$title }}</h3>
                                <div class="d-flex align-items-center">
                                    <img src="{{ $testimony->photo }}" style="max-width:100%" class="m-auto" />
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
