<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>飲酒日記</title>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>

  <body>
    <div class="container-fluid" id="app">
      <div class="row">
        <div class="header col-12">
          <h1>飲酒日記</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-5 offset-1">
          <h2>HOME</h2>
        </div>
        <div class="col-5 text-right">
          @if(Auth::check())
            <p>{{$username}}</p>
          @else
            <a href="login">ログイン</a>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col-10 offset-1">
          <!--<show-total></show-total>-->
          @foreach ($inshu_sum as $inshu)
            {{$inshu['kind']}}
            {{$inshu['amount']}}
          @endforeach
          <div>
            <form action="post" method="post">
              @csrf
              <post-inshu></post-inshu>
            </form>

            <a href="show">セッション</a>
            <a href="logout">ログアウト</a>
            <a href="register">ユーザー登録</a>
          </div>
        </div>
      </div>
    </div>
    <script src="{{ asset('/js/app.js') }}"></script>
  </body>

</html>
