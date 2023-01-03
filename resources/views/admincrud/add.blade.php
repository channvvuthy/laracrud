@extends('admincrud.layout.master')
@section('content')
    <div class="d-flex flex-row">
        <a href="{{ Helper::indexUrl() }}">
            <i class="fa fa-chevron-circle-left text-info"></i>
            <span class="text-info">Back to list @if (isset($data['back']) && $data['back'])
                    {{ $data['back'] }}
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
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <div class="px-3 pt-4">
                @if (isset($data['form']) && $data['form'])
                    <div class="col-{{ $data['col'] }}">
                        <div class="row">
                            @foreach ($data['form'] as $key => $form)
                                <div class="col-{{ $data['grid'] }}">
                                    <div class="mb-3 row">
                                        @if ($form['type'] == 'text')
                                            <label for="{{ $form['field'] }}"
                                                   class="col-sm-2 col-form-label">
                                                {{ $form['title'] }}@if (isset($form['required']) && $form['required'])
                                                    <span class="text-danger">*</span>
                                                @endif
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="{{ $form['type'] }}" class="form-control"
                                                       id="{{ $form['field'] }}" name="{{ $form['field'] }}"
                                                       @if (isset($form['required']) && $form['required']) required @endif>
                                            </div>
                                        @elseif($form['type'] =="select")
                                            <label for="{{ $form['field'] }}"
                                                   class="col-sm-2 col-form-label">{{ $form['title'] }}</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="{{ $form['field'] }}"
                                                        @if (isset($form['required']) && $form['required']) required @endif>
                                                    <option selected>Please select {{$form['title']}}</option>
                                                    @foreach($data[$form['field']] as $select)
                                                        <option value="{{$select->id}}">{{$select->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @else
                                            @if (isset($form['multiple']) && $form['multiple'])
                                                <label for="{{ $form['field'] }}"
                                                       class="col-sm-2 col-form-label">
                                                    {{ $form['title'] }}
                                                    @if (isset($form['required']) && $form['required'])
                                                        <span class="text-danger">*</span>
                                                    @endif
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="{{ $form['type'] }}" class="form-control"
                                                           style="padding-top:3px;" id="{{ $form['field'] }}"
                                                           name="{{ $form['field'] }}[]"
                                                           accept="{{$form['accept']}}"
                                                           multiple
                                                           @if (isset($form['required']) && $form['required']) required @endif>
                                                </div>
                                            @else

                                                <label for="{{ $form['field'] }}"
                                                       class="col-sm-2 col-form-label">{{ $form['title'] }}
                                                    @if (isset($form['required']) && $form['required'])
                                                        <span class="text-danger">*</span>
                                                    @endif</label>
                                                <div class="col-sm-10">
                                                    <input type="{{ $form['type'] }}" class="form-control"
                                                           style="padding-top:3px;" id="{{ $form['field'] }}"
                                                           name="{{ $form['field'] }}"
                                                           accept="{{$form['accept']}}"
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
                            <button type="button" class="btn btn-secondary">Back</button>
                        </a>
                        <button type="submit" class="btn btn-success mx-2" value="{{ URL::current() }}" name="save">
                            Save & Add More
                        </button>
                        <button type="submit" class="btn btn-success" value="{{ Helper::indexUrl() }}"
                                name="save">Save
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
