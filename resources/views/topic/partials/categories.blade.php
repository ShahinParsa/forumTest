<div class="row">
    <div class="col-md-12">
        <h4>Catagory's</h4>
        <ul class="list-group">

            @foreach (\App\cat::listAllCats() as $category)
                <li class="list-group-item">
                        {{$category->name}}
                        <span class="badge badge-success float-right">{{$category->catsTopicsCount()}}</span>
                    <ul class="list-group">
                        @foreach(\App\sub_cat::listAllSubCats() as $subcategory)
                            @if ($subcategory->cat_id === $category->id)
                                <a href="{{route('showByCat.Topic', $subcategory->id)}}">
                        <li class="list-group-item" >
                            {{$subcategory->name}}
                            <span class="badge badge-light float-right">{{$subcategory->countTopics()}}</span>
                        </li></a>
                            @endif
                            @endforeach
                    </ul>
                </li>
        </ul>

        @endforeach

    </div>
</div>