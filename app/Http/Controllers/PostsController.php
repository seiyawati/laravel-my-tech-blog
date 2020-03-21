<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Posts\CreatePostsRequest;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Tag;
use App\Category;
use App\Http\Requests\Posts\UpdatePostsRequest;


class PostsController extends Controller
{
    public function __construct(){
        //create,storeだけこのミドルウェアが働く
        $this->middleware('verifyCategoriesCount')->only(['create','store']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        $posts = Post::all();
        return view('posts.index',[
            'posts' => $posts
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
 
        return view('posts.create',[
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
       
        //storage/app/public配下にデータが保存される,storeメソッでディレクトリ指定
        //この一行で画像自体のアップロードは完了
        $image = $request->image->store('posts');

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->content = $request->content;
        $post->image = $image;//画像パスをデータベースに保存
        $post->published_at = $request->published_at;
        $post->category_id = $request->category;
        $post->user_id = Auth::user()->id;
        $post->save();

        //ポストに選択されたタグを持たせるという意味、attachを用いる
        if($request->tags){
            $post->tags()->attach($request->tags);
        }

        session()->flash('flash_message','投稿が完了しました');

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $post = Post::find($id);
        // dd($post->tags->toArray());
       
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.create',[
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostsRequest $request, $id)
    {
        $post = Post::find($id);
        //$data = $request->only(['title','description','published_at','content']);

        //画像が新しい物ならアップデートする
        if($request->hasFile('image')){

            //アップデート処理
            $image = $request->image->store('posts');

            //前の画像を削除する
            $post->deleteImage();

            $post->image = $image;
            //$data['image'] = $image
        }

        if($request->tags){
            $post->tags()->sync($request->tags);
        }

        //$dataに配列として入れてアップデートする
        //$post->update($data);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->content = $request->content;
        $post->published_at = $request->published_at;
        $post->category_id = $request->category;
        $post->save();

        session()->flash('flash_message','編集が完了しました');

        return redirect(route('posts.index'));

        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //ソフトデリートされたモデルも取得する、firstOrFailでレコードがなければ例外を返す
        $post = Post::withTrashed()->where('id',$id)->firstOrFail();
        
        if($post->trashed()){
            //Storageによってファイル操作することができる
            $post->deleteImage();
            //ソフトデリートされた物を完全に削除する
            $post->forceDelete();
        } else{

            $post->delete();

        }

        session()->flash('flash_message','削除が完了しました');

        return redirect(route('posts.index'));

    }

    /**
     *Display a list of all trashed posts.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function trashed(){

        //ソフトデリート済のみモデルを含めるクエリ
        $trashed = Post::onlyTrashed()->get();

        return view('posts.index',[
            'posts' => $trashed
        ]);
    }

    public function restore($id){
        //ソフトデリート済のモデルも含めるクエリ
        $post = Post::withTrashed()->where('id',$id)->firstOrFail();

        $post->restore();

        session()->flash('flash_message','復元が完了しました');

        //直前のURLへ戻る
        return redirect()->back();

    }


}
