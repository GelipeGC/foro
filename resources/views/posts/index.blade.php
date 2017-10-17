@extends('layouts.app')

@section('content')
  <h1>Posts</h1>
  @foreach($posts as $post)
    <li>
      <a href="{{ $post->url}}">
        {{ $post->title}}
      </a>
    </li>
  @endforeach

  {{ $posts->render()}}

@endsection