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
                {{ __('common.' . Helper::getDetailTitle()) }}
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
                                    @if ($detail['field'] === 'status')
                                        {{ $detail['field'] == 2 ? __('common.Disable') : __('common.Enable') }}
                                    @else
                                        {{ is_array($data['find']) ? $data['find'][$detail['field']] : $data['find']->{$detail['field']} }}
                                    @endif
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @include('admin.components.file_preview')
@endsection
@push('script')
    <script>
        $(".files").on("click", function(e) {
            const uri = e.target.getAttribute('data-url');
            const type = e.target.getAttribute('data-type');

            function createImageElement(src) {
                const image = document.createElement("img");
                image.src = src;
                image.classList.add("img-fluid");
                image.classList.add("rounded");
                return image;
            }

            if (type === 'single_file') {
                const image = createImageElement(uri);
                $("#content_preview").html(image);
            } else {
                const files = uri.split(",");
                const fileDisplay = document.createElement("div");

                files.forEach(item => {
                    const image = createImageElement(item);
                    image.classList.add("mb-3");
                    fileDisplay.append(image);
                });

                $("#content_preview").html(fileDisplay);
            }

            $("#file_preview").modal("show");
        });
    </script>
@endpush
