<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use SoftDeletes;

    //$datesプロパティが指すフィールドに対し、データを取得しCarbonクラスのデータを置き換える処理をしてくれる。
    protected $dates = [

        'published_at',

    ];

    //複数代入する時に使いたい属性のみを指定する
    protected $fillable = [

        'title','description','content','image','published_at','category_id','user_id',
    ];

    /**
     * Delete post image from storage
     *
     * @return void
     */
    //コントローラー側での処理をすっきりさせる
    public function deleteImage(){
        Storage::delete($this->image);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }

    /**
     * check if post has tag
     *
     * @return boot
     */
    public function hasTag($tagId){
        //$tagIdがこのポストに紐ずくタグのidの配列の中にあればtrueを返す。
        return in_array($tagId,$this->tags->pluck('id')->toArray());
    }

    public function user(){

        return $this->belongsTo('App\User');

    }

    //今日より前の投稿だけを取得するようにする
    public function scopePublished($query){

        return $query->where('published_at','<=',now());

    }

    public function scopeSearched($query){

        //検索対象を取得
        $search = request()->query('search');

        if(!$search){

            return $query->published();
        }
        
        return $query->published()->where('title','LIKE',"%{$search}%");

    }


}
