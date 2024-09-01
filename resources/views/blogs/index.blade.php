
@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
            @foreach($post as $post)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('images/post/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                        <div class="card-body text-center">
                            <h5 class="card-title">
                                <a href="{{ route('post.show', $post->id) }}">
                                {{ $post->title }}
                                </a>
                            </h5>
                            <p>{{ substr($post->content, 0, 30).'...' }}</p>
                            <a href="{{ route('post.show', $post->id) }}" class="btn btn-warning btn-sm">Read More</a>                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection