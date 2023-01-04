@extends('admincrud.layout.master')
@section('content')
    <div class="d-flex flex-row">
        <a href="{{ Helper::indexUrl() }}">
            <i class="fa fa-chevron-circle-left text-info"></i>
            <span class="text-info">Back to list
                @if (isset($data['back']) && $data['back'])
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
        <form method="POST" enctype="multipart/form-data" action="{{ Helper::indexUrl() }}update">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <input type="hidden" name="id" value="{{ $data['find']->id }}">
            <div class="px-3 pt-4">
                @if (isset($data['form']) && $data['form'])
                    <div class="col-{{ $data['col'] }}">
                        <div class="row">
                            @foreach ($data['form'] as $key => $form)
                                <div class="col-{{ $data['grid'] }}">
                                    <div class="mb-3 row">
                                        @if ($form['type'] == 'text' || $form['type'] == 'number')
                                            <label for="{{ $form['field'] }}"
                                                   class="col-sm-2 col-form-label">{{ $form['title'] }}</label>
                                            <div class="col-sm-10">
                                                <input type="{{ $form['type'] }}" class="form-control"
                                                       value="{{ is_array($data['find'])?$data['find'][$form['field']] : $data['find']->{$form['field']} }}"
                                                       id="{{ $form['field'] }}"
                                                       name="{{ $form['field'] }}"
                                                       @if (isset($form['required']) && $form['required']) required @endif>
                                            </div>
                                        @elseif($form['type'] =="select")
                                            <label for="{{ $form['field'] }}"
                                                   class="col-sm-2 col-form-label">{{ $form['title'] }}</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="{{ $form['field'] }}"
                                                        @if (isset($form['required']) && $form['required']) required @endif>
                                                    <option>Please select {{$form['title']}}</option>
                                                    @if(isset($data[$form['field']]))
                                                        @foreach($data[$form['field']] as $select)
                                                            <option value="{{$select->id}}"
                                                                    @if($select->id == $data['find']->{$form['field']}) selected @endif>{{$select->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        @else
                                            @if (isset($form['multipart']) && $form['multipart'])
                                                <label for="{{ $form['field'] }}"
                                                       class="col-sm-2 col-form-label">{{ $form['title'] }}</label>
                                                <div class="col-sm-10">
                                                    <input type="{{ $form['type'] }}" class="form-control"
                                                           style="padding-top:3px;" id="{{ $form['field'] }}"
                                                           name="{{ $form['field'] }}[]"
                                                           @if (isset($form['required']) && $form['required']) required @endif>
                                                </div>
                                            @else
                                                <label for="{{ $form['field'] }}"
                                                       class="col-sm-2 col-form-label">{{ $form['title'] }}</label>
                                                <div class="col-sm-10">
                                                    <input type="{{ $form['type'] }}" class="form-control"
                                                           style="padding-top:3px;" id="{{ $form['field'] }}"
                                                           name="{{ $form['field'] }}"
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
                        <button type="submit" class="btn btn-success ml-2" value="{{ Helper::indexUrl() }}"
                                name="save">Save
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
