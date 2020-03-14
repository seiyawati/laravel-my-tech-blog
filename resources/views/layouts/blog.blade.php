<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title')
    </title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
</head>
<body>
    <header>
        <div class="bs-component">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
              <a class="navbar-brand" href="{{route('welcome')}}">Seiya Blog</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
  
              <div class="collapse navbar-collapse" id="navbarColor02">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('blog.profile')}}">プロフィール</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('contact.index')}}">お問い合わせ</a>
                  </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" action="{{route('welcome')}}" method="GET">
                    <input type="text" class="form-control" name="search" placeholder="Search" value="{{ request()->query('search') }}">  
                </form>
              </div>
            </nav>
        </div>
    </header>

    <section class="page-header">
        <div class="page-header text-center" id="banner">
            <div class="row my-4">
              <div class="col-12">
                <h2>Seiya Blog</h2>
                <p class="lead">
                    ようこそ！! このブログはプログラミング初心者が日々の学習のでの気づきをメモしているブログです。
                </p>
              </div>
            </div>
        </div>
    </section>

    <!--Main Content-->
    @yield('content')

    <hr>
    
   <!-- Footer -->
    <footer class="footer">
      <p class="text-center">Copyright © 2020 Seiya Blog All Rights Reserved.</p>
    </footer>
    
    
    
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $('.bs-component [data-toggle="popover"]').popover();
        $('.bs-component [data-toggle="tooltip"]').tooltip();
    </script>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5e64dd5f77479566"></script>
</body>
</html>