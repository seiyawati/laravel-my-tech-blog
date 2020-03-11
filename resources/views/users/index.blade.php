@extends('layouts.app')

@section('content')

<div class="card">

    <div class="card-header">ユーザー</div>

    <div class="card-body">
    @if($users->count() > 0)
        <table class="table">

            <thead>

                <th>画像</th>

                <th>名前</th>

                <th>メールアドレス</th>

                <th></th>

            </thead>

            <tbody>

                @foreach($users as $user)

                    <tr>
                        <td>
                           <img width="40px" heigth="40px" style="border-radius: 50% " src=" {{Gravatar::src($user->email)}}" alt="">
                        </td>

                        <td>
                            {{$user->name}}
                        </td>

                        <td>
                            {{$user->email}}
                        </td>
                        
                        <td>
                        @if(!$user->isAdmin())
                            <form action="{{route('users.make-admin',$user->id)}}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">make admin</button>
                            </form>
                        @endif    
                        </td>
                      
                    </tr>

                @endforeach   

            </tbody>

        </table>
        @else
        <h3 class="text-center">まだ投稿者はいません</h3>
        @endif

    </div>

</div>

@endsection