@extends('layouts.app')
@section('content')
    <h1>{{ $post->title}}</h1>
    <p>{!! $post->safe_html_content !!}</p>
    {{ $post->user->name}}

    {!! Form::open(['route' => ['posts.subscribe', $post], 'method' => 'POST'])!!}
            <button type="submit">Subscribirse al post</button>
    {!! Form::close()!!}
    <h4>Comentarios</h4>

    {!! Form::open(['route' => ['comments.store', $post], 'method' => 'POST']) !!}
        {!! Field::textarea('comment') !!}

        <button type="submit">Publicar comentario</button>
    {!! Form::close(); !!}

    @foreach($post->latestComments as $comment)
        <div class="{{ $comment->answer ? 'answer' : ''}}">
            {{ $comment->comment}}
            @if(Gate::allows('accept', $comment) && !$comment->answer)
            {!! Form::open(['route' => ['comments.accept', $comment], 'method' => 'POST']) !!}
                <button type="submit">Aceptar respuesta</button>
            {!! Form::close()!!}
            @endif
        </div>
    @endforeach
@endsection