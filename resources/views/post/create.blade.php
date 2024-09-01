@extends('layouts.app')
@section('content')
<form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
    @csrf
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
            <td><input type="text" class="form-control" name="title" id="" placeholder="Title"></td>
        </tr>
        <tr>
            <td><textarea name="content" class="form-control" id="" placeholder="Content"></textarea></td>
        </tr>
        <tr>
            <td><input type="file" name="image" id="" class="form-control"></td>
        </tr>
        <tr>
            <td>
                <button type="submit" class="btn btn-primary btn-sm">Save Post</button>
            </td>
        </tr>
    </table>
</form>
@endsection