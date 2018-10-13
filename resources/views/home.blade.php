@extends('layouts.app')

@section('content')
<div class="container">
    @guest
    <div class="row">
      <div class="col-10">
        <a  class="btn btn-primary" href="auth/twitter"><i class="fab fa-twitter mr-2"></i>Login with Twitter</a>
      </div>
    </div>
    @else
    <div class="row justify-content-center">
      <div class="col-md-8">
        <show-total></show-total>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-4">
        <form action="post" method="post">
          @csrf
          <post-inshu></post-inshu>
        </form>
      </div>
    </div>
    @endguest
</div>
@endsection
