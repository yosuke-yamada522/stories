@extends('app')

@section('title', $user->name . 'のファン')

@section('content')
  @include('nav')
  <div class="container">
    @include('users.user')
    @include('users.tabs', ['hasStories' => false, 'hasLikes' => false])
    @foreach($funs as $person)
      @include('users.person')
    @endforeach
  </div>
@endsection