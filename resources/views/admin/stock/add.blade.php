@extends('admin.layout.master')
@section('content')
    <div class="d-flex flex-row">
        <a href="{{ Helper::indexUrl() }}">
            <i class="fa fa-chevron-circle-left text-info"></i>
            <span class="text-info">
                {{ __('common.Back to list') }}
                {{ __('common.' . Helper::getModuleName()) }}
            </span>
        </a>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <h4>
                {{ __('common.' . Helper::getAddTitle()) }}
            </h4>
        </div>
        <form method="POST" enctype="multipart/form-data" action="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="px-3 pt-4">
            </div>
        </form>
    </div>
@endsection
@if (isset($data['wysiwyg']) && $data['wysiwyg'])
    @push('style')
        <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    @endpush
    @push('script')
        <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
        <script>
            $(function() {
                // Summernote
                $('#summernote').summernote({
                    height: 200
                })
            })
        </script>
    @endpush
@endif

@if (isset($data['select2']) && $data['select2'])
    @push('style')
        <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    @endpush
    @push('script')
        <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
        <script>
            $(function() {
                $('.select2').select2();
            })
        </script>
    @endpush
@endif
