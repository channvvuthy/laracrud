@extends('admincrud.layout.master')
@section('module')
    @include('admincrud.partial.module')
@endsection
@section('content')
    @include('admincrud.partial.filter')
    @push('module')
        @include('admincrud.partial.module')
    @endpush
    @include('admincrud.partial.export')
    <table class="table table-bordered table-responsive-sm">
        <thead>
        <tr>
            @if (isset($data['display_id']) && $data['display_id'])
                <th>ID</th>
            @endif
            @foreach ($data['head'] as $key => $col)
                @if(!isset($col['view']))
                    <th>{{ $col['title'] }}</th>
                @endif
            @endforeach
            @if ($data['has_action'])
                <th class="text-center" width="{{$data['action_with']}}">Action</th>
            @endif
        </tr>
        </thead>

        <tbody>
        @foreach ($data['result'] as $key => $result)
            <tr>
                <td>{{ $key + 1 }}</td>
                @foreach ($data['head'] as $key => $col)
                    @if(!isset($col['view']))
                        <td>
                            @if(isset($col['type']))
                                @if($col['type'] == 'image' && isset($col['multiple']))
                                    <a href="#"
                                       class="files">
                                        <i class="fa fa-image text-gray"
                                           data-url="{{ is_array($result)?$result[$col['field']]:$result->{$col['field']}  }}"
                                           data-type="multiple_file"></i>
                                    </a>
                                @else
                                    <a href="#"
                                       class="files">
                                        <i class="fa fa-image text-gray"
                                           data-url="{{ is_array($result)?$result[$col['field']]:$result->{$col['field']}  }}"
                                           data-type="single_file"></i>
                                    </a>
                                @endif
                            @else
                                {{Helper::subStr(is_array($result)?$result[$col['field']]:$result->{$col['field']},20) }}
                            @endif

                        </td>
                    @endif
                @endforeach
                @if ($data['has_action'])
                    <td>
                        <div class="d-flex flex-row justify-content-center">
                            @if ($data['view'])
                                <div class="mr-2">
                                    <a href="{{Helper::indexUrl()}}/detail/{{is_array($result)?$result[$data['pk']]:$result->{$data['pk']} }}">
                                        <button type="button" class="btn btn-primary btn-sm">
                                            <i class="fa fa-eye"></i>
                                            View
                                        </button>
                                    </a>
                                </div>
                            @endif
                            @if ($data['edit'])
                                <div class="mr-2">
                                    <a href="{{Helper::indexUrl()}}/edit/{{is_array($result)?$result[$data['pk']]:$result->{$data['pk']} }}">
                                        <button type="button" class="btn btn-success btn-sm">
                                            <i class="fa fa-edit"></i>
                                            Edit
                                        </button>
                                    </a>
                                </div>
                            @endif
                            @if ($data['delete'])
                                <div>
                                    <a href="#" class="btn-delete"
                                       data-id="{{is_array($result)?$result[$data['pk']]:$result->{$data['pk']} }}">
                                        <button type="button" class="btn btn-danger btn-sm"
                                                data-id="{{is_array($result)?$result[$data['pk']]:$result->{$data['pk']} }}">
                                            <i class="fa fa-trash"></i>
                                            Delete
                                        </button>
                                    </a>
                                </div>
                            @endif
                            @if(isset($data['appendedButton']))
                                @foreach($data['appendedButton'] as $btn)
                                        <div class="ml-2">
                                            <a href="{{$btn['action']}}/{{is_array($result)?$result[$data['pk']]:$result->{$data['pk']} }}"
                                               data-id="{{is_array($result)?$result[$data['pk']]:$result->{$data['pk']} }}">
                                                <button type="button" class="{{$btn['btn']}} btn-sm">
                                                    <i class="{{$btn['icon']}}"></i>
                                                    {{$btn['name']}}
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
        </tbody>
    </table>
    @include('admincrud.components.confirm')
    @include('admincrud.components.file_preview')
    {{--Pagination --}}
    <div>
        {{ $data['result']->links() }}
    </div>
@endsection
@push('script')
    <script>
        let delete_id;

        $(".btn-delete").on("click", function (e) {
            $("#confirm").modal("show");
            delete_id = e.target.getAttribute('data-id');
        });

        $(".btn-delete-item").on("click", function () {
            window.location.href = "{{Helper::indexUrl()}}/delete/" + delete_id;
        });

        $(".files").on("click", function (e) {
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
