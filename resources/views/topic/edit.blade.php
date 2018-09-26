@extends('layouts.front')

@section('Heading',"Create a new topic")

@section('content')
    @include('layouts.partials.error')
    @include('layouts.partials.success')

    <div class="col-12">
        <form class="form-vertical" action="{{route('topic.update', $topic->id)}}" method="post" role="form" id="create-topic-form">
            {{csrf_field()}}
            {{method_field('put')}}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="" placeholder="put your title here ..."
                       value="{{$topic->title}}">
            </div>

            <div class="form-group">
                <select class="custom-select" name="sub_cat_id">

                    @foreach($cats as $cat)
                        <optgroup label="{{$cat->name}}">

                        @foreach($subCats as $sub_cat)

                            @if($sub_cat->cat_id === $cat->id)
                            <option value="{{$sub_cat->id}}">{{$sub_cat->name}}</option>
                            @endif

                        @endforeach

                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="topic_body">Topic</label>
                <textarea type="text" class="form-control" name="topic_body" id="" style="height: 400px" placeholder="content here ...">{{$topic->topic_body}}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>

        </form>

    </div>

@endsection