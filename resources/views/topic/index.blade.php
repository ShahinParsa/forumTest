@extends('layouts.front')

{{--@if($request->session()->has('auth'))--}}
@if(\Illuminate\Support\Facades\Auth::check())

    @section('heading')
        <div class="col-12 topic_index_header">
        <a class="btn btn-primary float-right" href="{{route('topic.create')}}" style="margin-bottom: 30px;">Create new Topic</a>
        </div>
        <div class="col-12">
            @include('layouts.partials.error')
            @include('layouts.partials.success')
        </div>
    @endsection

@endif

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="col-12">
                @include('topic.partials.categories')
            </div>

        </div>
        <div class="col-md-9">
            @include('topic.partials.topics-list')
        </div>
    </div>

@endsection