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
                <div class="panel-heading">お問い合わせ</div>
                <div class="panel-body">
                    @include('partials.errors')
                <form action="{{route('contact.confirm')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>お名前</label>
                        <input type="text" class="form-control" name="name" placeholder="お名前" value="">
                    </div>
                    <div class="form-group">
                        <label>メールアドレス</label>
                        <input type="text" class="form-control" name="email" placeholder="メールアドレス" value="">
                    </div>
                    <div class="form-group">
                        <label>お問い合わせ内容</label>
                        <textarea class="form-control" name="body" rows="5" placeholder="本文"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">入力内容確認</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <div class="container">
    <div class="row">
        <div class="col-12">
            <h1>お問い合わせ</h1>
            <form method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="お名前" value="">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="メールアドレス" value="">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="subject" placeholder="件名" value="">
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="message" rows="5" placeholder="本文"></textarea>
                </div>
                <button type="submit" class="btn btn-success btn-block">送信</button>
            </form>
        </div>
    </div>
</div> -->



@endsection
