<div class="row mb-3">
    <div class="col-md-6 col-sm-12">
        <div class="d-flex flex-row align-items-center">
            <div>
                <h3 class="m-0">
                    {{ __('common.' . Helper::getListTitle()) }}
                </h3>
            </div>
            @if ($data['add'] ?? false && !in_array($data['method'], ['add', 'edit']))
                <div class="mx-2">
                    <a href="{{ Request::url() }}/add?{{ Request::getQueryString() }}">
                        <button type="button" class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i> {{ __('common.Add New') }}
                        </button>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
