<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Category;


class PostsController extends Controller
{
    public function show($id){

        //find()はオブジェクトを返り値にとる
        $post = Post::find($id);
        //モデルのオブジェクトを渡す,get()はコレクションを返り値にとる
        // $tags = $post->tags()->get();
        $tags = Tag::all();
        $categories = Category::all();
     
        

        return view('blog.show',[
            'post' => $post,
            'tags' => $tags,
            'categories' => $categories, 
           
        ]);
    }

    public function category($id){

        // $search = request()->query('search');
        // if($search){
        //     $posts = $category->posts()->where('title','LIKE',"%{$search}%")->simplePaginate(3);
        // } else{
        //     $posts = $category->posts()->simplePaginate(3);
        // } 

        $category = Category::find($id);
        //サーチスコープ
        $posts = $category->posts()->searched()->simplePaginate(3);

        $categories = Category::all();

        $tags = Tag::all();
        
        return view('blog.category',[
            'category' => $category,
            'categories' => $categories,
            'tags' => $tags,
            'posts' => $posts,
        ]);
    }

    public function tag($id){

        $tag = Tag::find($id);
        $tags = Tag::all();
        $categories = Category::all();
        //サーチスコープ
        $posts = $tag->posts()->searched()->simplePaginate(3);

        return view('blog.tag',[
            'tag' => $tag,
            'categories' => $categories,
            'tags' => $tags,
            'posts' => $posts,
        ]);
    }

    public function profile(){
        return view('blog.profile');
    }
}
