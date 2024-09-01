@extends('layouts.app')
@section('content')

<h2>Leave a Comment</h2>

<form method="POST" action="{{ route('comments.store', $post->id) }}">
    @csrf
    <textarea class="form-control" name="text" cols="30" rows="5" placeholder="Enter your comment"></textarea>
    <button type="submit" class="btn btn-primary btn-sm">Post Comment</button>
</form>
@endsection