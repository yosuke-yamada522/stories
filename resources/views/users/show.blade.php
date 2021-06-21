@extends('app')

@section('title', $user->name)

@section('content')
  @include('nav')
  <div class="container">
    @include('users.user')
    @include('users.tabs', ['hasStories' => true, 'hasLikes' => false])
    @foreach($stories as $story)
      @include('stories.card')
    @endforeach
  </div>
@endsection