<div class="row mb-3">
    <div class="col-6">
        <div class="d-flex flex-row align-items-center">
            <div>
                <h3 class="m-0">
                    @if (isset($data['title']))
                        {{ $data['title'] }}
                    @endif
                </h3>
            </div>
            @if (isset($data['add']) && $data['add'] && ($data['method'] != 'add' && $data['method'] != 'edit'))
                <div class="mx-2">
                    <a href="{{ Request::url() }}/add">
                        <button type="button" class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i> Add New
                        </button>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
