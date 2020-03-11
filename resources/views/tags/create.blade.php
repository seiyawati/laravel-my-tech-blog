@extends('layouts.app')

@section('content')

<div class="card card-default">

    <div class="card-header">
        <!--三項演算子を用いている、＜条件式＞?＜真式＞:＜偽式＞-->
        {{isset($tag) ? 'Edit tag' : 'Create tag'}}
    </div>

        <div class="card-body">
            @include('partials.errors')
            <form action="{{ isset($tag) ? route('tags.update',$tag->id) : route('tags.store') }}" method="POST">

                @csrf

                @if(isset($tag))

                    @method('PUT')

                @endif    

                
                <div class="form-group">

                    <label for="name">Name</label>

                    <input type="text" id="name" class="form-control" name="name" value="{{isset($tag) ? $tag->name : ''}}">

                </div>

                <div class="form-group">

                    <button class="btn btn-success">

                        {{isset($tag) ? '更新' : '追加'}}
                        
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection