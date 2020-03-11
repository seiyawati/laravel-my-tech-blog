<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Http\Requests\Tags\CreateTagRequest;
use App\Http\Requests\Tags\UpdateTagsRequest;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();

        return view('tags.index',[
            'tags' => $tags
            ]);
        //return view('categories.index')->with('categories',Category::all()); 上記と同じ意味
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTagRequest $request)
    {
        // //バリテーションはリクエストに記述
        // $this->validate($request,[
        //     'name' => 'required|unique:categories'//uniqueは一意（値がひとつであるとを示している。）
        // ]);

        $tag = new Tag();
        $tag->name = $request->name;
        $tag->save();
        
        /** 上記と同じ意味
        * Category::create([
        * 'name' => $request->name
        * ]);
        */

        //フラッシュメッセージ
        session()->flash('flash_message','タグが追加されました。');

        return redirect(route('tags.index'));

        
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
        $tag = Tag::find($id);

        return view('tags.create',[
            'tag' => $tag
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagsRequest $request, $id)
    {
        $tag = Tag::find($id);
        $tag->name = $request->name;
        $tag->save();

        //Eloquent,DBとモデルオブジェクトを結びつける,updateメソッド
        //上記と同じ内容になる
        // $category->update([
        //     'name' => $request->name
        // ]);

        session()->flash('flash_message','タグが更新されました。');

        return redirect(route('tags.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);

        if($tag->posts->count() > 0){

            session()->flash('error','タグを削除することはできません。');

            return redirect()->back();
        }

        $tag->delete();

        session()->flash('flash_message','タグは削除されました。');

        return redirect(route('tags.index'));


    }
}
