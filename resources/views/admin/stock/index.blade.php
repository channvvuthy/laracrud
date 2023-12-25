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
  
@endsection
