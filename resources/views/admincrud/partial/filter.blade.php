@if ($data['filter'])
    @if (is_array($data['filter']))
        <div class="mb-3">
            <form>
                <div class="d-flex flex-row mb-3 justify-content-end">
                    @foreach ($data['filter'] as $key => $field)
                        <div class="mr-2">
                            @if ($field['type'] == 'text')
                                <input type="{{ $field['type'] }}" class="form-control" name="{{ $field['field'] }}"
                                    placeholder="{{ isset($field['placeholder']) ? $field['placeholder'] : '' }}">
                            @endif
                            @if ($field['type'] == 'picker')
                                <div class="input-group date {{ $field['field'] }}" id="{{ $field['field'] }}"
                                    data-target-input="nearest">
                                    <input type="{{ $field['type'] }}" class="form-control datetimepicker-input"
                                        data-target="#{{ $field['field'] }}" name="{{ $field['field'] }}"
                                        placeholder="{{ isset($field['placeholder']) ? $field['placeholder'] : '' }}" />
                                    <div class="input-group-append" data-target="#{{ $field['field'] }}"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                    <div>
                        <button type="button" class="btn btn-dark">Search</button>
                    </div>
                </div>
            </form>
        </div>
    @endif
@endif
