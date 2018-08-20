@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-10">
        <form action="post" method="post">
          @csrf
          <post-inshu></post-inshu>
        </form>
        <show-total></show-total>
      </div>
    </div>
</div>
@endsection
