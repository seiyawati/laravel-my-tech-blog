@extends('layouts.blog')

@section('title')

Seiya Blog

@endsection


@section('content')
<!-- Main Content -->
<section>
        <div class="row">
            <div class="col-lg-12">
              <h2>記事一覧/</h2>
            </div>
        </div>
      
        <div class="row">
            <div class="col-lg-8">
                <div class="bs-component">
                  @forelse($posts as $post)
                    <div class="card mb-3 border-primary " style="max-width: 100%;">
                        <div class="card-header"><span class="badge badge-pill badge-primary">{{$post->category->name}}</span> / @foreach($post->tags as $tag)<span class="badge badge-pill badge-secondary">{{$tag->name}}</span> @endforeach</div>
                        <div class="card-body">
                            <h4 class="card-title"><a href="{{route('blog.show',$post->id)}}" style="color:black;">{{$post->title}}</a></h4>
                            <p class="card-text">{{$post->description}}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-content">
                      該当する検索結果が見つかりません。<strong>{{ request()->query('search') }}</strong>
                    </p>
                    @endforelse
                    <!--実行時に検索結果のページネーションのリンクを作るようにする-->
                    {{ $posts->appends(['search' => request()->query('search')])->links() }}
                </div>
            </div>    
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
        </div>    
    </section>
@endsection    





