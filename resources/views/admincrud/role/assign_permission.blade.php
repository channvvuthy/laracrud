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
    <div class="row">
        <div class="col-6">
            <table class="table table-responsive-sm table-bordered ">
                <thead>
                <tr class="table-active">
                    <th>Permission</th>
                    <th>Allow</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($data['permissions']) && count($data['permissions']))
                    @foreach($data['permissions'] as $permission)
                        <tr>
                            <td>{{Str::ucfirst($permission->name)}}</td>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input permission"
                                           @checked($data['find']->hasPermissionTo($permission->name))
                                           value="{{$permission->id}}" data-name="{{$permission->name}}">
                                </div>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('script')
    @include('admincrud.script.ajax')
    <script>
        $(".permission").on("click", function (e) {
            let permission = e.target.value;
            let name = e.target.getAttribute('data-name');
            ajaxPost("{{URL::to('/')}}/admin/role/assign_permission", {
                "_token": "{{csrf_token()}}",
                permission,
                name,
                role: "{{$data['find']->id}}"
            }).catch(err => {
                console.log(err)
            });

        });
    </script>
@endpush
