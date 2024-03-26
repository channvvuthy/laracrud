@extends('admin.layout.master')
@section('module')
    @include('admin.partial.module')
@endsection
@section('content')
    @include('admin.partial.filter')
    @push('module')
        @include('admin.partial.module')
    @endpush
    @include('admin.partial.export')
    <table class="table table-bordered table-responsive-sm">
        <thead>
            <tr>
                @if (isset($data['display_id']) && $data['display_id'])
                    <th>{{ __('common.ID') }}</th>
                @endif
                @isset($data['head'])
                    @foreach ($data['head'] as $key => $col)
                        @if (!isset($col['view']))
                            <th>{{ __('common.' . $col['title'] ?? '') }}</th>
                        @endif
                    @endforeach
                    @if ($data['has_action'])
                        <th class="text-center" width="{{ $data['action_with'] }}">{{ __('common.Action') }}</th>
                    @endif
                @endisset

            </tr>
        </thead>

        <tbody>
            @isset($data['result'])
                @foreach ($data['result'] as $key => $result)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        @foreach ($data['head'] as $key => $col)
                            @if (!isset($col['view']))
                                <td>
                                    @if (isset($col['type']))
                                        @if ($col['type'] == 'image' && isset($col['multiple']))
                                            <a href="#" class="files">
                                                <i class="fa fa-image text-gray"
                                                    data-url="{{ is_array($result) ? $result[$col['field']] : $result->{$col['field']} }}"
                                                    data-type="multiple_file"></i>
                                            </a>
                                        @elseif($col['type'] == 'gender')
                                            @if (is_array($result) ? $result[$col['field']] : $result->{$col['field']} == 1)
                                                <span>{{ __('common.Male') }}</span>
                                            @else
                                                <span>{{ __('common.Female') }}</span>
                                            @endif
                                        @elseif($col['type'] == 'status')
                                            @if (is_array($result) ? $result[$col['field']] : $result->{$col['field']} == 1)
                                                <span>{{ __('common.Enable') }}</span>
                                            @else
                                                <span>{{ __('common.Disable') }}</span>
                                            @endif
                                        @else
                                            <a href="#" class="files">
                                                <i class="fa fa-image text-gray"
                                                    data-url="{{ is_array($result) ? $result[$col['field']] : $result->{$col['field']} }}"
                                                    data-type="single_file"></i>
                                            </a>
                                        @endif
                                    @else
                                        @if ($col['field'] === 'status')
                                            {{ $result->{$col['field']} == 2 ? __('common.Disable') : __('common.Enable') }}
                                        @else
                                            @if (isset($col['database']))
                                                {{ Helper::getRelatedNameById($col['database'], $result->{$col['field']}) }}
                                            @else
                                                {!! strip_tags(Helper::subStr(is_array($result) ? $result[$col['field']] : $result->{$col['field']}, 40)) !!}
                                            @endif
                                        @endif
                                    @endif

                                </td>
                            @endif
                        @endforeach
                        @if ($data['has_action'])
                            <td>
                                <div class="d-flex flex-row justify-content-center">
                                    @if ($data['view'])
                                        <div class="mr-2">
                                            <a
                                                href="{{ Helper::indexUrl() }}/detail/{{ is_array($result) ? $result[$data['pk']] : $result->{$data['pk']} }}">
                                                <button type="button" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                    {{ __('common.View') }}
                                                </button>
                                            </a>
                                        </div>
                                    @endif
                                    @if ($data['edit'])
                                        <div class="mr-2">
                                            <a
                                                href="{{ Helper::indexUrl() }}/edit/{{ is_array($result) ? $result[$data['pk']] : $result->{$data['pk']} }}">
                                                <button type="button" class="btn btn-success btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                    {{ __('common.Edit') }}
                                                </button>
                                            </a>
                                        </div>
                                    @endif
                                    @if ($data['delete'])
                                        <div>
                                            <a href="#" class="btn-delete"
                                                data-id="{{ is_array($result) ? $result[$data['pk']] : $result->{$data['pk']} }}">
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    data-id="{{ is_array($result) ? $result[$data['pk']] : $result->{$data['pk']} }}">
                                                    <i class="fa fa-trash"></i>
                                                    {{ __('common.Delete') }}
                                                </button>
                                            </a>
                                        </div>
                                    @endif
                                    @if (isset($data['appendedButton']))
                                        @foreach ($data['appendedButton'] as $btn)
                                            <div class="ml-2">
                                                <a href="{{ $btn['action'] }}/{{ is_array($result) ? $result[$data['pk']] : $result->{$data['pk']} }}?parent={{ $btn['parent'] }}"
                                                    data-id="{{ is_array($result) ? $result[$data['pk']] : $result->{$data['pk']} }}">
                                                    <button type="button" class="{{ $btn['btn'] }} btn-sm">
                                                        <i class="{{ $btn['icon'] }}"></i>
                                                        {{ $btn['name'] }}
                                                    </button>
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            @endisset
        </tbody>
    </table>
    @include('admin.components.confirm')
    @include('admin.components.file_preview')
    {{-- Pagination --}}
    @isset($data['result'])
        @if ($data['result']->lastPage() > 1)
            <div class="d-flex justify-content-end">
                {{ $data['result']->links('admin.pagination') }}
            </div>
        @endif
    @endisset
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            let deleteId;

            $(".btn-delete").on("click", function(e) {
                $("#confirm").modal("show");
                deleteId = e.target.getAttribute('data-id');
            });

            $(".btn-delete-item").on("click", function() {
                window.location.href = "{{ Helper::indexUrl() }}" + `/delete/${deleteId}`;
            });

            $(".files").on("click", function(e) {
                let uri = e.target.getAttribute('data-url');
                let type = e.target.getAttribute('data-type');
                let contentPreview = $("#content_preview");

                if (type === 'single_file') {
                    contentPreview.html(`<img src="${uri}" class="img-fluid rounded">`);
                } else {
                    let files = uri.split(",");
                    let fileDisplay = $("<div>");

                    files.forEach(item => {
                        let image = $("<img>").attr({
                            src: item,
                            class: "img-fluid mb-3 rounded"
                        });
                        fileDisplay.append(image);
                    });

                    contentPreview.html(fileDisplay);
                }

                $("#file_preview").modal("show");
            });
        });
    </script>
@endpush
