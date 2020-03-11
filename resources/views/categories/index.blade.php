@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end mb-2">
    <a href="{{ route('categories.create') }}" class="btn btn-success">カテゴリーを追加する</a>
</div>

<div class="card card-default">
    <div class="card-header">カテゴリー</div>
    <div class="card-body">
        @if($categories->count() > 0)
        <table class="table">
            <thead>
                <th>カテゴリー名</th>
                <th>投稿数</th>

            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>
                            {{$category->name}}
                        </td>
                        <td>
                            <!--postsプロパティによりカテゴリーに紐ずくポストコレクションを取得-->
                            {{$category->posts->count()}}
                        </td>
                        <td>
                            <a href="{{route('categories.edit',$category->id)}}" class="btn btn-info btn-sm">
                                編集
                            </a>
                            <button class="btn btn-danger btn-sm" onclick="handleDelete({{$category->id}})">削除</button>
                        </td>
                    </tr>
                @endforeach    
            </tbody>
        </table>

        
<!-- モーダルの設定 -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
  <div class="modal-dialog" role="document">
   <form action=""method="POST" id="deleteCategoryForm"> 
       @csrf
       @method('DELETE')
       <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">カテゴリー削除</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>本当に削除してもよろしいですか？</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
        <button type="submit" class="btn btn-primary">削除</button>
      </div><!-- /.modal-footer -->
    </div><!-- /.modal-content -->
   </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@else
<h3 class="text-center">まだカテゴリーはありません</h3>
@endif
    </div>
</div>
@endsection

@section('script')
<script>
    function handleDelete(id){
        
        var form = document.getElementById('deleteCategoryForm');
        form.action = '/categories/' + id;
        $('#deleteModal').modal('show');
        // console.log('deleting',form);デバッグ処理

    }
</script>