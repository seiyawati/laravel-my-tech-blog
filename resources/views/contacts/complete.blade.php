@extends('layouts.blog')

@section('title')

Seiya Blog

@endsection

@section('header')
<!-- Header -->
<header class="header text-center text-white" style="background-image:url('https://cdn.pixabay.com/photo/2017/10/27/15/12/geeks-2894621_1280.jpg')">
      <div class="container">

        <div class="row">
          <div class="col-md-8 mx-auto">

            <h1>Seiya Blog</h1>
            <p class="lead-2 opacity-90 mt-6">
                このブログは日々の学習のメモとして使っています、初学者さんの参考になれば幸いです。
            </p>

          </div>
        </div>

      </div>
</header><!-- /.header -->
@endsection

@section('content')
<p>送信は完了しました！！</p>
@endsection