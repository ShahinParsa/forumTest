<div class="list-group">
    @forelse($topics as $topic)

        <a href="{{route('topic.show', $topic->id)}}" class="list-group-item">
            <div class="col-md-12 list_style">
            <div class="row">
                <div class="col-md-11">
                    <h4 class="list-group-item-primary">{{str_limit($topic->title, 40)}}</h4>
                </div>
                <div class="col-md-1">
                    <span class="badge badge-info">{{$topic->sub_cat->cat->name}} / {{$topic->sub_cat->name}}</span>
                </div>
                <div class="col-md-11">
                    <p class="list-group-item-text">{{str_limit($topic->topic_body, 99)}} /Read more ...
                    </p>
                </div>

            </div>


            <div class="row" style="font-size: 10px!important;">
                <div class="col-md-8 float-left">
                    <p>Auteur: {{$topic->user->name}}</p>
                </div>

                {{--<div class="col-md-8 float-left">
                    <p>Category: {{$topic->sub_cat->cat->name}} -> {{$topic->sub_cat->name}}</p>
                </div>--}}

                <div class="col-md-4 float-right text-right">
                    {{--<p>Date: {{date('d-m-Y', strtotime($topic->created_at))}}</p>--}}
                    <p>Creation date: {{\Carbon\Carbon::parse($topic->created_at)->format('d/m/Y')}}</p>
                </div>

            </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <span class="border_bottom_list"></span>
                </div>
            </div>



        </a>

    @empty

        <h4>No topic's yet...</h4>

    @endforelse
</div>