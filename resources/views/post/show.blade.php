@extends('layouts.app')
@section('content')
<h1>{{ $post->title }}</h1>
<img src="{{ asset('images/post/'. $post->image) }}" alt="" class="w-100">
<p class="mt-5">{!! $post->content !!}</p>
<h2>Comments</h2>
<ul>
    @foreach($post->comments ?? [] as $comment)
    <li>
        <p>{{ $comment->content }}</p>
        <p>— {{ $comment->user->name }}</p>
    </li>
    @endforeach
</ul>
@if(auth()->check())
<form action="{{ route('comments.store', $post->id) }}" method="post">
    @csrf
    <div class="row">
        <div class="col-12">
            <textarea class="form-control" name="content"></textarea>
        </div>
        <div class="col-12 mt-2">
            <button class="btn btn-sm btn-primary" type="submit">Comment</button>
        </div>
    </div>
</form>



@else
<p>You need to <a href="{{ route('login') }}">login</a> to comment.</p>
@endif


@if($post->comment)
@foreach($post->comment as $comment)

<div class="card mt-3">
    <div class="card-body">
        {{ $comment->content}}
    </div>
    <div class="card-footer">
        <div class="" style="text-align: right">
            By: {{ ucfirst($comment->user->name) }} at {{ date ('d F Y H:i a', strtotime($comment->created_at))}}
        </div>
    </div>
</div>

@endforeach
@endif

@endsection