@extends('layouts.blog')

@section('title')
{{$post->title}}
@endsection

@section('content')

<section>
  
  <div class="row">
    <div class="col-lg-8">
      <h3>{{$post->title}}</h3>
      <p>{{$post->publised_at}}</p>
      <hr>
      {!!$post->content!!}

      <!-- Go to www.addthis.com/dashboard to customize your tools -->
      <div class="addthis_inline_share_toolbox"></div>
            
      <a href="{{route('welcome')}}" style="color:black">記事一覧へ</a>
    </div> 
    @include('partials.sidebar')
  </div>

</section>

@endsection
 

