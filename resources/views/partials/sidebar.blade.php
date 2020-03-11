<div class="col-md-4 col-xl-3">
    <div class="sidebar px-4 py-md-0">
        <h6 class="sidebar-title">検索</h6>
            <form class="input-group" action="{{route('welcome')}}" method="GET">
                <input type="text" class="form-control" name="search" placeholder="Search" value="{{ request()->query('search') }}">
                <div class="input-group-addon">
                    <span class="input-group-text"><i class="ti-search"></i></span>
                </div>
            </form>

                <hr>

                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        カテゴリー
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($categories as $category)
                        <li class="list-group-item"> 
                            <a href="{{route('blog.category',$category->id)}}" style="color:black">
                            {{$category->name}} ({{$category->posts->count()}})
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- <h6 class="sidebar-title">カテゴリー</h6>
                <div class="row link-color-default fs-14 lh-24">
                    @foreach($categories as $category)
                    <div class="col-6">
                        <a href="{{route('blog.category',$category->id)}}">
                            {{$category->name}}
                        </a>
                    </div>
                    @endforeach
                </div> -->

                <hr>

                <!-- <h6 class="sidebar-title">Top posts</h6>
                <a class="media text-default align-items-center mb-5" href="blog-single.html">
                  <img class="rounded w-65px mr-4" src="../assets/img/thumb/4.jpg">
                  <p class="media-body small-2 lh-4 mb-0">Thank to Maryam for joining our team</p>
                </a>

                <a class="media text-default align-items-center mb-5" href="blog-single.html">
                  <img class="rounded w-65px mr-4" src="../assets/img/thumb/3.jpg">
                  <p class="media-body small-2 lh-4 mb-0">Best practices for minimalist design</p>
                </a>

                <a class="media text-default align-items-center mb-5" href="blog-single.html">
                  <img class="rounded w-65px mr-4" src="../assets/img/thumb/5.jpg">
                  <p class="media-body small-2 lh-4 mb-0">New published books for product designers</p>
                </a>

                <a class="media text-default align-items-center mb-5" href="blog-single.html">
                  <img class="rounded w-65px mr-4" src="../assets/img/thumb/2.jpg">
                  <p class="media-body small-2 lh-4 mb-0">Top 5 brilliant content marketing strategies</p>
                </a> -->

                <hr>

                <!-- <h6 class="sidebar-title">タグ</h6>
                <div class="gap-multiline-items-1">
                  @foreach($tags as $tag)  
                    <a class="badge badge-secondary" href="{{route('blog.tag',$tag->id)}}">
                        {{$tag->name}}
                    </a>
                  @endforeach  
                </div> -->

                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        タグ
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($tags as $tag)
                        <li class="list-group-item"> 
                            <a href="{{route('blog.tag',$tag->id)}}" style="color:black">
                            {{$tag->name}} ({{$tag->posts->count()}})
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>


    
                <hr>

                <div class="card" style="width: 18rem;">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image cap"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"/><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text></svg>
                        <div class="card-body">
                            <h5 class="card-title">プロフィール</h5>
                            <p class="card-text">東京海洋大学に在学中の大学生です。PHPとJavaScriptを扱っています。フレームワークはLaravelとjQueryです。</p>
                        </div>
                        <div class="card-body">
                            <a href="#" class="card-link">詳しいプロフィールはこちら</a>
                        </div>
                </div>


                <!-- <h6 class="sidebar-title">About</h6>
                <p class="small-3">TheSaaS is a responsive, professional, and multipurpose SaaS, Software, Startup and WebApp landing template powered by Bootstrap 4. TheSaaS is a powerful and super flexible tool for any kind of landing pages.</p> -->
    </div>
</div>