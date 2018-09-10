@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-10">
        @guest
          <a href="/login">ログイン</a>
        @else
          <form action="post" method="post">
            @csrf
            <post-inshu></post-inshu>
          </form>
          <show-total></show-total>
        @endguest
      </div>
    </div>
</div>
@endsection
