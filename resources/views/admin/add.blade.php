@extends('admin.layout.master')
@section('content')
    <div class="d-flex flex-row">
        <a href="{{ Helper::indexUrl() }}">
            <i class="fa fa-chevron-circle-left text-info"></i>
            <span class="text-info">{{ __('common.Back to list') }} @if (isset($data['back']) && $data['back'])
                    {{ __('common.' . $data['back']) }}
                @endif
            </span>
        </a>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <h4>
                @if (isset($data['title']))
                    {{ $data['title'] }}
                @endif
            </h4>
        </div>
        <form method="POST" enctype="multipart/form-data" action="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="px-3 pt-4">
                @if (isset($data['form']) && $data['form'])
                    <div class="col-{{ $data['col'] }}">
                        <div class="row">
                            @foreach ($data['form'] as $key => $form)
                                <div class="col-{{ $data['grid'] }}">
                                    <div class="mb-3 row">
                                        @if ($form['type'] == 'text' || $form['type'] == 'number')
                                            <label for="{{ $form['field'] }}" class="col-sm-2 col-form-label">
                                                {{ __('common.'.$form['title']) }}@if (isset($form['required']) && $form['required'])
                                                    <span class="text-danger">*</span>
                                                @endif
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="{{ $form['type'] }}" class="form-control"
                                                    id="{{ $form['field'] }}" name="{{ $form['field'] }}"
                                                    @if (isset($form['required']) && $form['required']) required @endif>
                                            </div>
                                        @elseif($form['type'] == 'textarea')
                                            <label for="{{ $form['field'] }}" class="col-sm-2 col-form-label">
                                                {{ __('common.'.$form['title']) }}@if (isset($form['required']) && $form['required'])
                                                    <span class="text-danger">*</span>
                                                @endif
                                            </label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" rows="3" style="resize: none;" id="{{ $form['field'] }}"
                                                    name="{{ $form['field'] }}" @if (isset($form['required']) && $form['required']) required @endif></textarea>
                                            </div>
                                        @elseif($form['type'] == 'wysiwyg')
                                            <label for="{{ $form['field'] }}" class="col-sm-2 col-form-label">
                                                {{ __('common.'.$form['title']) }}@if (isset($form['required']) && $form['required'])
                                                    <span class="text-danger">*</span>
                                                @endif
                                            </label>
                                            <div class="col-sm-10">
                                                <textarea id="summernote" name="{{ $form['field'] }}" @if (isset($form['required']) && $form['required']) required @endif>
                                                </textarea>
                                            </div>
                                        @elseif($form['type'] == 'select')
                                            <label for="{{ $form['field'] }}"
                                                class="col-sm-2 col-form-label">{{ __('common.'.$form['title']) }}</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="{{ $form['field'] }}"
                                                    @if (isset($form['required']) && $form['required']) required @endif>
                                                    <option selected>{{__('common.Please select')}} {{ __('common.'.$form['title']) }}</option>
                                                    @foreach ($data[$form['field']] as $select)
                                                        <option value="{{ $select->id }}">{{ $select->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @elseif($form['type'] == 'select2')
                                            <label for="{{ $form['field'] }}"
                                                class="col-sm-2 col-form-label">{{ __('common.'.$form['title']) }}</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2" style="width: 100%;"
                                                    @if (isset($form['required']) && $form['required']) required @endif>
                                                    <option selected>{{__('common.Please select')}} {{ __('common.'.$form['title']) }}</option>
                                                    @foreach ($data[$form['field']] as $select)
                                                        <option value="{{ $select->id }}">{{ $select->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @elseif($form['type'] == 'gender')
                                            <label for="{{ $form['field'] }}"
                                                class="col-sm-2 col-form-label">{{ __('common.'.$form['title']) }}</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2" style="width: 100%;"
                                                    @if (isset($form['required']) && $form['required']) required @endif>
                                                    <option selected>{{__('common.Please select')}} {{ __('common.'.$form['title']) }}</option>
                                                    <option value="1">{{__('common.Male')}}</option>
                                                    <option value="2">{{__('common.Female')}}</option>

                                                </select>
                                            </div>
                                        @elseif($form['type'] == 'status')
                                            <label for="{{ $form['field'] }}"
                                                class="col-sm-2 col-form-label">{{ __('common.'.$form['title']) }}</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2" style="width: 100%;"
                                                    @if (isset($form['required']) && $form['required']) required @endif>
                                                    <option selected>{{__('common.Please select')}} {{ __('common.'.$form['title']) }}</option>
                                                    <option value="1">{{__('common.Enable')}}</option>
                                                    <option value="2">{{__('common.Disable')}}</option>

                                                </select>
                                            </div>
                                        @else
                                            @if (isset($form['multiple']) && $form['multiple'])
                                                <label for="{{ $form['field'] }}" class="col-sm-2 col-form-label">
                                                    {{ __('common.'.$form['title']) }}
                                                    @if (isset($form['required']) && $form['required'])
                                                        <span class="text-danger">*</span>
                                                    @endif
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="{{ $form['type'] }}" class="form-control"
                                                        style="padding-top:3px;" id="{{ $form['field'] }}"
                                                        name="{{ $form['field'] }}[]"
                                                        @if (isset($form['accept'])) accept="{{ $form['accept'] }}" @endif
                                                        multiple @if (isset($form['required']) && $form['required']) required @endif>
                                                </div>
                                            @else
                                                <label for="{{ $form['field'] }}"
                                                    class="col-sm-2 col-form-label">{{ __('common.'.$form['title']) }}
                                                    @if (isset($form['required']) && $form['required'])
                                                        <span class="text-danger">*</span>
                                                    @endif
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="{{ $form['type'] }}" class="form-control"
                                                        style="padding-top:3px;" id="{{ $form['field'] }}"
                                                        name="{{ $form['field'] }}"
                                                        @if (isset($form['accept'])) accept="{{ $form['accept'] }}" @endif
                                                        @if (isset($form['required']) && $form['required']) required @endif>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-2 "></div>
                    <div class="col-sm-10 d-flex flex-row">
                        <a href="{{ Helper::indexUrl() }}">
                            <button type="button" class="btn btn-secondary">{{__('common.Back')}}</button>
                        </a>
                        <button type="submit" class="btn btn-success mx-2" value="{{ URL::current() }}" name="save">
                            {{__('common.Save & Add More')}}
                        </button>
                        <button type="submit" class="btn btn-success" value="{{ Helper::indexUrl() }}" name="save">{{__('common.Save')}}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@if (isset($data['wysiwyg']) && $data['wysiwyg'])
    @push('style')
        <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    @endpush
    @push('script')
        <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
        <script>
            $(function() {
                // Summernote
                $('#summernote').summernote({
                    height: 200
                })
            })
        </script>
    @endpush
@endif

@if (isset($data['select2']) && $data['select2'])
    @push('style')
        <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    @endpush
    @push('script')
        <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
        <script>
            $(function() {
                $('.select2').select2();
            })
        </script>
    @endpush
@endif
