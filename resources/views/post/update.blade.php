@extends('layouts.app')
@section('content')
<form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method("put")
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <table class="table">
        <tr>
            <td><input type="text" value="{{ $post->title }}" class="form-control" name="title" id="" placeholder="Title"></td>
        </tr>
        <tr>
            <td><textarea name="content" class="form-control" id="" placeholder="Content">{{ $post->content }}</textarea></td>
        </tr>
        <tr>
            <td><input type="file" name="image" id="" class="form-control"><br>
            @if(!empty($post->image))
                <img src="{{ asset('images/post/'.$post->image) }}" width="70"/>
            @endif
        </td>
        </tr>
        <tr>
            <td>
                <button type="submit" class="btn btn-primary btn-sm">Update Post</button>
            </td>
        </tr>
    </table>
</form>
@endsection