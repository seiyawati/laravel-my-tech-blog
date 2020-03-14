@extends('layouts.blog')

@section('title')

Sass Blog

@endsection

@section('content')
<div class="row">
  <div class="col-lg-12">
    <h2>記事一覧/{{$category->name}}</h2>
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
  @include('partials.sidebar')
</div>      
@endsection   