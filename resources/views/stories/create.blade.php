@extends('app')

@section('title', '小説投稿')

@include('nav')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <dic class="card mt-3">
          <div class="card-body pt-0">
            @include('error_card_list')
            <div class="card-text">
              <form method="POST" action="{{ route('stories.store') }}">
                @include('stories.form')
                <button type="submit" class="btn blue-gradient btn-block">投稿</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection