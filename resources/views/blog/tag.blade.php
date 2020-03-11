@extends('layouts.blog')

@section('title')

Sass Blog

@endsection

@section('header')
<!-- Header -->
<header class="header text-center text-white" style="background-image:url('https://cdn.pixabay.com/photo/2017/10/27/15/12/geeks-2894621_1280.jpg')">
      <div class="container">

        <div class="row">
          <div class="col-md-8 mx-auto">

            <h1>{{$tag->name}}</h1>
            <p class="lead-2 opacity-90 mt-6">{{$tag->name}}に関する記事一覧です</p>

          </div>
        </div>

      </div>
</header><!-- /.header -->
@endsection

@section('content')
<!-- Main Content -->
<main class="main-content">
      <div class="section bg-gray">
        <div class="container">
          <div class="row">


            <div class="col-md-8 col-xl-9">
              <div class="row gap-y">

              <!--$postsが空かどうかの判断をしてくれる、あればforeach的な働きをする-->
                @forelse($posts as $post)
                <div class="col-md-6">
                  <div class="card border hover-shadow-6 mb-6 d-block">
                    <a href="{{route('blog.show',$post->id)}}"><img class="card-img-top" src="{{asset('storage/'.$post->image)}}" alt="Card image cap"></a>
                    <div class="p-6 text-center">
                        <p>
                            <a class="small-5 text-lighter text-uppercase ls-2 fw-400" href="#">
                              {{$post->category->name}}
                            </a>
                        </p>
                        <h5 class="mb-0">
                            <a class="text-dark" href="{{route('blog.show',$post->id)}}">
                              {{$post->title}}
                            </a>
                        </h5>
                    </div>
                  </div>
                </div>
                @empty
                <p class="text-content">
                    該当する検索結果が見つかりません。<strong>{{ request()->query('search') }}</strong>
                </p>
                @endforelse

              </div>
              <!--実行時に検索結果のページネーションのリンクを作るようにする-->
              {{ $posts->appends(['search' => request()->query('search')])->links() }}
            </div>


           @include('partials.sidebar')

          </div>
        </div>
      </div>
    </main>
@endsection    