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
                {{ __('common.' . Helper::getRealTitleFromRoute()) }}
            </h4>
        </div>
        <div class="px-3 ">
            <div>
                <ul class="list-group list-group-flush">
                    @foreach ($data['head'] as $detail)
                        <li class="list-group-item">
                            <div class="d-flex flex-row align-items-center">
                                <b class="mr-2">{{ __('common.' . ucwords($detail['title'])) }}: </b>
                                @if (isset($detail['type']) && $detail['type'] == 'image')
                                    @if (isset($detail['multiple']))
                                        <a href="#" class="files">
                                            <i class="fa fa-image text-gray"
                                                data-url="{{ is_array($data['find']) ? $data['find'][$detail['field']] : $data['find']->{$detail['field']} }}"
                                                data-type="multiple_file"></i>
                                        </a>
                                    @else
                                        <a href="#" class="files">
                                            <i class="fa fa-image text-gray"
                                                data-url="{{ is_array($data['find']) ? $data['find'][$detail['field']] : $data['find']->{$detail['field']} }}"
                                                data-type="single_file"></i>
                                        </a>
                                    @endif
                                @else
                                    {{ is_array($data['find']) ? $data['find'][$detail['field']] : $data['find']->{$detail['field']} }}
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
@include('admin.components.file_preview')
@push('script')
    <script>
        $(".files").on("click", function(e) {
            let uri = e.target.getAttribute('data-url');
            let type = e.target.getAttribute('data-type');
            if (type == 'single_file') {
                let image = document.createElement("img");
                image.classList.add("img-fluid");
                image.classList.add("rounded");
                image.src = uri
                $("#content_preview").html(image)
            } else {
                let files = uri.split(",");
                let fileDisplay = document.createElement("div")

                files.forEach(item => {
                    let image = document.createElement("img");
                    image.src = item
                    image.classList.add("img-fluid");
                    image.classList.add("mb-3");
                    image.classList.add("rounded");
                    fileDisplay.append(image)
                })
                $("#content_preview").html(fileDisplay);
            }
            $("#file_preview").modal("show");
        });
    </script>
@endpush
