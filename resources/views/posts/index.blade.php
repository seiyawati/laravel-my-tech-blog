@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-end mb-2">

    <a href="{{route('posts.create')}}" class="btn btn-success">新規投稿</a>

</div>

<div class="card">

    <div class="card-header">投稿</div>

    <div class="card-body">
    @if($posts->count() > 0)
        <table class="table">

            <thead>

                <th>画像</th>

                <th>タイトル</th>

                <th>カテゴリー</th>

                <th></th>

            </thead>

            <tbody>

                @foreach($posts as $post)

                    <tr>
                        <td>
                            <!--assetヘルパーでファイルのパスを返す-->
                            <img  width="120px" heigth="60px" src="{{asset('storage/'.$post->image)}}"  alt="">
                            <!-- <img src="{{asset('mm.png')}}" alt=""> -->
                        </td>

                        <td>
                            {{$post->title}}
                        </td>

                        <td>
                            <!--ポストに紐ずくカテゴリーの名前を取得-->
                            <!--cateogoryはひとつだからnameを直接呼んでいる。-->
                            <a href="{{route('categories.edit',$post->category->id)}}">
                                {{$post->category->name}}
                            </a>
                        </td>

                        @if($post->trashed())
                        <td>
                            <form action="{{route('restore-posts',$post->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                    <button type="submit" class="btn btn-info btn-sm">復元</button>
                            </form>         
                        </td>
                        @else
                        <td>
                
                            <a href="{{route('posts.edit',$post->id)}}"class="btn btn-info btn-sm">
                                編集
                            </a>
                            
                        </td>
                        @endif
                        


                        <td>    

                            <form action="{{route('posts.destroy',$post->id)}}" method="POST" >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    {{$post->trashed() ? '削除' : 'ゴミ箱へ'}}
                                </button>
                            </form>
                            
                        </td>
                    </tr>

                @endforeach   

            </tbody>

        </table>
        @else
        <h3 class="text-center">まだ投稿はありません</h3>
        @endif

    </div>

</div>

@endsection

