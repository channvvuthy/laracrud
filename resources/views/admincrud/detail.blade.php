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
        <div class="px-3 ">
            <div>
                <ul class="list-group list-group-flush">
                    @foreach($data['detail'] as $detail)
                        <li class="list-group-item"><b>{{str_replace("_"," ",ucwords($detail))}}
                                : </b> {{$data['find'][$detail]}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
