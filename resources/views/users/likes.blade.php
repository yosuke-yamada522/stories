@extends('app')

@section('title', $user->name . 'のいいねしたストーリー')

@section('content')
  @include('nav')
  <div class="container">
    @include('users.user')
    @include('users.tabs', ['hasStories' => false, 'hasLikes' => true])
    @foreach($stories as $story)
      @include('stories.card')
    @endforeach
  </div>
@endsection