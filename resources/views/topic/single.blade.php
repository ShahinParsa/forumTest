@extends('layouts.front')

@section('content')
    @include('layouts.partials.error')
    @include('layouts.partials.success')
    <div class="col-md-12 single_topic">
        <div class="row">
            <div class="col-md-9">
                <h4>{{$topic->title}}</h4>
                <hr>
                <p>{{$topic->topic_body}}</p>
            </div>

            <div class="col-md-3 topic_info_single_page" style="font-size: 13px!important; min-height: 200px;">
                <ul class="list-group">
                    <li class="">Auteur: <a href="#">{{$topic->user->name}}</a></li>
                    <li class="">Category: <span
                                class="badge badge-pill badge-light">{{$topic->sub_cat->cat->name}}</span></li>
                    <li class="">Subcategory: <span class="badge badge-pill badge-dark">{{$topic->sub_cat->name}}</span>
                    </li>
                    <li class="">Creation date: {{date('d-m-Y', strtotime($topic->created_at))}}</li>
                    <li class="">Last Update: {{date('d-m-Y', strtotime($topic->updated_at))}}</li>
                </ul>

                {{--edit/delete topic buttons--}}

                @if(\Illuminate\Support\Facades\Auth::check())

                    @if(\App\User::hasAccess($topic->user->id) || \App\User::isAdmin() || \App\User::isModerator())
                        <div class="col-12 text-center" style="margin-top: 20px">
                            <div class="actions">
                                <a href="{{route('topic.edit',$topic->id)}}" class="btn btn-info btn-sm">Edit topic</a>

                                <form onsubmit="return confirm('Do you really want to delete your topic?');"
                                      action="{{route('topic.destroy', $topic->id)}}" method="post" class="inline-it">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <input class="btn btn-danger btn-sm" type="submit" value="Delete">
                                </form>
                            </div>
                        </div>
                    @endif
                @endif
            </div>


            {{--comments and reply section--}}


            <div class="col-md-12 comment_section">
                @if(\Illuminate\Support\Facades\Auth::check())

                    {{--add comment--}}
                    <div class="comment-form" style="margin-top: 30px">
                        <form action="{{route('topicComment.store', $topic->id)}}" method="post" role="form">
                            {{csrf_field()}}
                            <legend>Comment</legend>

                            <div class="form-group">

                            <textarea type="text" style="height: 100px" class="form-control" name="body" id=""
                                      placeholder=""></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </form>
                    </div>


                    @foreach($topic->comments as $comment)

                        <div class="comments-list">
                            <h4>{{$comment->body}}</h4>
                            <br>
                            <lead>by: {{$comment->user->name}}</lead>


                            {{--EDIT COMMENT--}}

                            @if(\App\User::hasAccess($topic->user->id) || \App\User::isAdmin() || \App\User::isModerator())
                                <div class="col-md-12" style="margin-top: 10px">

                                    <a class="btn btn-light btn-sm" data-toggle="modal"
                                       href="#{{$comment->id}}">Edit
                                        comment</a>
                                    <div class="modal" id="{{$comment->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">&times;
                                                    </button>
                                                </div>


                                                <div class="modal-body">
                                                    <div class="comment-form">
                                                        <form action="{{route('comment.update', $comment->id)}}"
                                                              method="post" role="form">
                                                            {{csrf_field()}}
                                                            {{method_field('put')}}
                                                            <legend>Edit comment</legend>

                                                            <div class="form-group">

                                                                <input type="text" style="height: 100px"
                                                                       class="form-control" name="body" id=""
                                                                       placeholder="" value="{{$comment->body}}">
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Update
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{--EDIT COMMENT--}}

                                    {{--DELETE COMMENT--}}
                                    <div class="float-right" style="margin-right: 5px">

                                        <form onsubmit="return confirm('Do you really want to delete your topic?');"
                                              action="{{route('comment.destroy', $comment->id)}}" method="post"
                                              class="inline-it">
                                            {{csrf_field()}}
                                            {{method_field('DELETE')}}
                                            <input class="btn-xs btn-danger" type="submit" value="Delete">
                                        </form>
                                    </div>

                                    {{--DELETE COMMENT--}}

                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-12">
                                    <span class="border_bottom_list" style="margin-bottom: 20px;"></span>
                                </div>
                            </div>


                            {{--Reply--}}
                            <div class="col-md-12 reply_section">

                                {{--//reply form--}}

                                {{--show hide reply form--}}
                                {{--<button class="btn-xs btn-dark" onclick="toggleReply('{{$comment->id}}')" style="margin-top: 20px">Reply</button>--}}

                                <div class="reply-form-{{$comment->id}}">
                                    <form action="{{route('commentReply.store', $comment->id)}}" method="post"
                                          role="form">
                                        {{csrf_field()}}
                                        <legend>Reply</legend>

                                        <div class="form-group">

                            <textarea type="text" style="height: 40px" class="form-control" name="body" id=""
                                      placeholder=""></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Send</button>
                                    </form>
                                    <br>
                                </div>

                                @foreach($comment->comments as $reply)
                                    <div class="text-info reply-list" style="margin-left: 30px">
                                        <h5>{{$reply->body}}</h5>
                                        <lead>by: {{$reply->user->name}}</lead>


                                        {{--Edit reply--}}

                                        @if(auth()->user()->id === $reply->user_id)
                                            <div class="col-md-12" style="margin-top: 10px">

                                                <a class="btn-sm btn-light" style="font-size: smaller"
                                                   data-toggle="modal"
                                                   href="#{{$reply->id}}">Edit
                                                    Reply</a>
                                                <div class="modal" id="{{$reply->id}}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-hidden="true">&times;
                                                                </button>
                                                            </div>


                                                            <div class="modal-body">
                                                                <div class="comment-form">
                                                                    <form action="{{route('comment.update', $reply->id)}}"
                                                                          method="post" role="form">
                                                                        {{csrf_field()}}
                                                                        {{method_field('put')}}
                                                                        <legend>Edit reply</legend>

                                                                        <div class="form-group">

                                                                            <input type="text" style="height: 100px"
                                                                                   class="form-control" name="body"
                                                                                   id=""
                                                                                   placeholder=""
                                                                                   value="{{$reply->body}}">
                                                                        </div>
                                                                        <button type="submit" class="btn btn-primary">
                                                                            Update
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{--EDIT REPLY--}}

                                                {{--DELETE reply--}}
                                                <div class="float-right" style="margin-right: 5px">

                                                    <form onsubmit="return confirm('Do you really want to delete your topic?');"
                                                          action="{{route('comment.destroy', $reply->id)}}"
                                                          method="post"
                                                          class="inline-it">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}
                                                        <input class="btn-sm btn-danger" style="font-size: smaller"
                                                               type="submit"
                                                               value="Delete">
                                                    </form>
                                                </div>

                                                {{--DELETE reply--}}

                                            </div>
                                        @endif

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <span class="border_bottom_list" style="margin-bottom: 20px;"></span>
                                        </div>
                                    </div>


                                @endforeach

                            </div>

                        </div>
                    @endforeach


                @else

                    <h3>You must login.</h3>

                @endif

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function toggleReply(commentId) {
            $('.reply-form-' + commentId).removeClass('hidden');
        }
    </script>

@endsection