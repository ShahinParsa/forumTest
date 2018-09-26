@extends('layouts.front')

@section('Heading',"Create a new topic")

@section('content')
    @include('layouts.partials.error')
    @include('layouts.partials.success')

    <div class="col-12">
        <form class="form-vertical" action="{{route('topic.store')}}" method="post" role="form" id="create-topic-form">
            {{csrf_field()}}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="" placeholder="put your title here ..."
                       value="{{old('title')}}">
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
                <label for="topic_body">Topic content</label>
                <textarea type="text" class="form-control" style="height: 300px" name="topic_body" id="" placeholder="put your text here ..."
                          >{{old('topic_body')}}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

        </form>

    </div>

@endsection