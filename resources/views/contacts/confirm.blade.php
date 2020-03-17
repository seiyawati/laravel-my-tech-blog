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
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><p class="text-center">入力内容確認</p></div>
                <div class="panel-body">
                <form action="{{route('contact.complete')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>お名前</label>:
                        {{$inputs->name}}
                        <input type="hidden" class="form-control" name="name" placeholder="お名前" value="{{$inputs->name}}">
                    </div>
                    <div class="form-group">
                        <label>メールアドレス</label>:
                        {{$inputs->email}}
                        <input type="hidden" class="form-control" name="email" placeholder="メールアドレス" value="{{$inputs->email}}">
                    </div>
                    <div class="form-group">
                        <label>お問い合わせ内容</label>:
                        {{$inputs->body}}
                        <input type="hidden" class="form-control" name="body" placeholder="本文" value="{{$inputs->body}}">
                    </div>
                    <button type="submit" class="btn btn-primary" name="action" value="back">入力内容修正</button>
                    <button type="submit" class="btn btn-success" name="action" value="submit">送信</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection