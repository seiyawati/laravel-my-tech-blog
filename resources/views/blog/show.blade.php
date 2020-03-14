@extends('layouts.blog')

@section('title')
{{$post->title}}
@endsection

@section('content')
<section>
  
  <div class="row">
    <div class="col-lg-8">
      <h3>・{{$post->title}}/<span class="badge badge-primary">Primary</span></h3>
      <p>{{$post->publised_at}}</p>
      <hr>
      {!!$post->content!!}
    </div>
    @include('partials.sidebar')
  </div>

</section>

@endsection
 

