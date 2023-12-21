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
    <div class="d-flex flex-row mb-3">
        <a href="/admin/role">
            <i class="fa fa-chevron-circle-left text-info"></i>
            <span class="text-info">Back to list
                @if (isset($data['back']) && $data['back'])
                    {{ $data['back'] }}
                @endif
            </span>
        </a>
    </div>
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
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input permission"
                                           @checked($data['find']->hasPermissionTo($permission->name))
                                           value="{{$permission->id}}" data-name="{{$permission->name}}"/>
                                </label>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('script')
    @include('admin.script.ajax')
    <script>
        $(".permission").on("click", function (e) {
            let permission = e.target.value;
            let name = e.target.getAttribute('data-name');
            ajaxPost("{{URL::to('/')}}/admin/role/assign_permission", {
                "_token": "{{csrf_token()}}",
                permission,
                name,
                role: "{{$data['find']->id}}"
            }).then(() => {
                $(document).Toasts('create', {
                    title: 'Success',
                    body: "Permission has been updated",
                    class: 'bg-success',
                    autohide: true,
                })
            })
                .catch(err => {
                    console.log(err)
                });

        });
    </script>
@endpush
