<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Post;
use App\Category;

class WelcomeController extends Controller
{
    public function index(){

        // $search = request()->query('search');

        // if($search){
        //     //LIKE演算子で$searchに該当するtitleのpostsをビルダクラスとして得る
        //     $posts = Post::where('title','LIKE',"%{$search}%")->simplePaginate(1);

        // } else{

        //     //paginateで指定の投稿数にページネーションしてくれる
        //     $posts = Post::simplePaginate(3);

        // }

        //スコープにより上の条件を満たした$postsを取得
        $posts = Post::searched()->simplePaginate(4);

        $tags = Tag::all();

        $categories = Category::all();

        return view('welcome',[
            'tags' => $tags,
            'categories' => $categories,
            'posts' => $posts,
        ]);

    }
}
