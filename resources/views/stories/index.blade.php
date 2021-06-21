@extends('app')

@section('title', '作品一覧')

@section('content')

  @include('nav')
  <h3 class="text-center">最新小説</h3>
  <div class="container">
    @foreach($stories as $story)
      @include('stories.card')
    @endforeach  
  </div>
@endsection