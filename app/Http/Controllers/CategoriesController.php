<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoriesRequest;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();


        return view('categories.index',['categories' => $categories ]);
        //return view('categories.index')->with('categories',Category::all()); 上記と同じ意味
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        // //バリテーションはリクエストに記述
        // $this->validate($request,[
        //     'name' => 'required|unique:categories'//uniqueは一意（値がひとつであるとを示している。）
        // ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();
        
        /** 上記と同じ意味
        * Category::create([
        * 'name' => $request->name
        * ]);
        */

        //フラッシュメッセージ
        session()->flash('flash_message','カテゴリーが追加されました。');

        return redirect(route('categories.index'));

        
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
        $category = Category::find($id);

        return view('categories.create',[
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoriesRequest $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();

        //Eloquent,DBとモデルオブジェクトを結びつける,updateメソッド
        //上記と同じ内容になる
        // $category->update([
        //     'name' => $request->name
        // ]);

        session()->flash('flash_message','カテゴリーが更新されました。');

        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if($category->posts->count() > 0){
            //カテゴリーに紐ずくポストがある状態で削除するとポスト側にデータが残ったままの状態になる
            session()->flash('error','カテゴリーを削除することはできません。');
            return redirect()->back();
        }

        $category->delete();

        session()->flash('flash_message','カテゴリーは削除されました。');

        return redirect(route('categories.index'));


    }
}
