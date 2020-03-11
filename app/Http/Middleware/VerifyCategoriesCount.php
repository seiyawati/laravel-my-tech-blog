<?php

namespace App\Http\Middleware;

use Closure;
use App\Category;

class VerifyCategoriesCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Category::all()->count() === 0){

            session()->flash('error','投稿するにはカテゴリーを作る必要があります');
            return redirect(route('categories.create'));
        }

        return $next($request);

    }
}
