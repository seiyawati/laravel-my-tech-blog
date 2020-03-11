@extends('layouts.app')

@section('content')

<div class="card">

    <div class="card-header">
    {{isset($post) ? '投稿を編集する' : '投稿する'}}
    </div>

    <div class="card-body">
        @include('partials.errors')
        <!--enctype="multipart/from-data"はファイルを送る時のおまじないのようなもの-->
        <form action="{{ isset($post) ? route('posts.update',$post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            @if(isset($post))

                @method('PUT')

            @endif

            <div class="form-group">

                <label for="title">タイトル</label>

                <input type="text" class="form-control" name="title" id="title" value="{{isset($post) ? $post->title : ''}}">

            </div>

            <div class="form-group">

                <label for="description">説明</label>

                <textarea column="5" rows="5" class="form-control" name="description" id="description" >{{isset($post) ? $post->description : ''}}</textarea>

            </div>

            <div class="form-group">

                <label for="content">文章</label>
                <!--textareaにvalue属性はない-->
                <!-- <textarea column="5" rows="5" class="form-control" name="content" id="content">{{isset($post) ? $post->content : ''}}</textarea> -->
                
                <input id="content" type="hidden" name="content" value="{{isset($post) ? $post->content : ''}}">
                <trix-editor input="content"></trix-editor>
                
            </div>

            <div class="form-group">

                <label for="published_at">作成日時</label>

                <input type="text" class="form-control" name="published_at" id="published_at" value="{{isset($post) ? $post->published_at : ''}}"> 

            </div>

            @if(isset($post))
                <div class="form-group">
                    <img src="{{asset('storage/'.$post->image)}}" alt="" style="width:100%">
                </div>
            @endif

            <div class="form-group">

                <label for="image">画像</label>

                <input type="file" class="form-control" name="image" id="image">
             
            </div> 

            <div class="form-group">

                <label for="category">カテゴリー</label>

                <select  class="form-control" name="category" id="category">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}"
                            @if(isset($post))
                                @if($category->id === $post->category_id)
                                    selected
                                @endif
                            @endif       
                             >
                            {{$category->name}}
                        </option>
                    @endforeach    
                </select>    
             
            </div>

            @if($tags->count() > 0)
            <div class="form-group">
                <label for="tags">タグ</label>
                <select name="tags[]" id="tags" class="form-control tags-selector" multiple>
                    @foreach($tags as $tag)
                    <option value="{{$tag->id}}"
                        @if(isset($post))
                            @if($post->hasTag($tag->id))
                                selected
                            @endif    
                        @endif
                    >
                        {{$tag->name}}
                    </option>
                    @endforeach
                </select>
            </div>
            @endif

            
            <div class="form-group">

                <button class="btn btn-success" type="submit">

                    {{isset($post) ? "編集" : "投稿"}}

                </button>

            </div>



        </form>

    </div>

</div>

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr('#published_at',{
        enableTime: true,
        enableSeconds: true
    })

    $(document).ready(function() {
    $('。tags-selector').select2();
});

</script>
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" rel="stylesheet"></link>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection