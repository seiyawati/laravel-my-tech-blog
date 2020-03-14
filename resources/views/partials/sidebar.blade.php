<div class="col-lg-4">
    <div class="bs-component">
        <h4>カテゴリー</h4>
        <div class="card border-primary">
            <ul class="list-group">
            @foreach($categories as $category)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{route('blog.category',$category->id)}}" style="color:black">{{$category->name}}</a>
                <span class="badge badge-primary badge-pill">{{$category->posts->count()}}</span>
                </li>
            @endforeach  
            </ul>
        </div>
    </br>
        <h4>タグ</h4>
        <div class="card border-primary">
            <ul class="list-group">
            @foreach($tags as $tag)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{route('blog.tag',$tag->id)}}" style="color:black">{{$tag->name}}</a>
                <span class="badge badge-primary badge-pill">{{$tag->posts->count()}}</span>
                </li>
            @endforeach  
            </ul>
        </div>
    </div>    
</div>