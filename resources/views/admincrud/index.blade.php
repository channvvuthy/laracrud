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
    <table class="table table-bordered">
        <thead>
        <tr>
            @if ($data['display_id'])
                <th>ID</th>
            @endif
            @foreach ($data['head'] as $key => $col)
                <th>{{ $col['title'] }}</th>
            @endforeach
            @if ($data['has_action'])
                <th class="text-center" width="250">Action</th>
            @endif
        </tr>
        </thead>

        <tbody>
        @foreach ($data['result'] as $key => $result)
            <tr>
                <td>{{ $key + 1 }}</td>
                @foreach ($data['head'] as $key => $col)
                    <td>{{ $result[$col['field']] }}</td>
                @endforeach
                @if ($data['has_action'])
                    <td>
                        <div class="d-flex flex-row justify-content-center">
                            @if ($data['edit'])
                                <div class="mr-2">
                                    <a href="{{Helper::indexUrl()}}/detail/{{$result[$data['pk']]}}">
                                        <button type="button" class="btn btn-primary btn-sm">
                                            <i class="fa fa-eye"></i>
                                            View
                                        </button>
                                    </a>
                                </div>
                            @endif
                            @if ($data['delete'])
                                <div class="mr-2">
                                    <a href="{{Helper::indexUrl()}}/edit/{{$result[$data['pk']]}}">
                                        <button type="button" class="btn btn-success btn-sm">
                                            <i class="fa fa-edit"></i>
                                            Edit
                                        </button>
                                    </a>
                                </div>
                            @endif
                            @if ($data['view'])
                                <div>
                                    <a href="#" class="btn-delete" data-id="{{$result[$data['pk']]}}">
                                        <button type="button" class="btn btn-danger btn-sm"
                                                data-id="{{$result[$data['pk']]}}">
                                            <i class="fa fa-trash"></i>
                                            Delete
                                        </button>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
    @include('admincrud.components.confirm')
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

    </script>
@endpush
