@extends('layouts.front')
@section('heading')

        <div class="col-12">
            <div class="jumbotron" style="text-align: center">
                <h1>WELCOME DUMMY</h1>
            </div>
        </div>

@endsection


@section('content')
    <div class="row">
            @forelse($topics as $topic)

    <div class="col-sm-4 home_card">
        <div class="card h-100">
            <img class="card-img-top" src="{{$topic->img_url}}" alt="{{$topic->title}}">
            <div class="card-body ">
                <h5 class="card-title">{{$topic->title}}</h5>
                <p class="card-text">{{str_limit($topic->topic_body, 60)}}</p>
                <div class="col-12">
                <a href="{{route('topic.show', $topic->id)}}" class="btn btn-primary">Read</a></div>
            </div>
        </div>
    </div>


            @empty

                <h4>No topic's yet...</h4>

            @endforelse
            </div>
@endsection