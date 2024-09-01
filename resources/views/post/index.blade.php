@extends("layouts.app")
@section("content")
<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Image</th>
            <th>Created date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>

        @forelse ($items as $post)
        <tr>
            <td>{{ $post->id }}</td>
            <td>
                <a href="{{ route('post.show', $post->id) }}" class="href">{!! $post->title !!}</a>
            </td>
            <td>
                @if(!empty($post->image))
                <img src="{{ asset('images/post/'.$post->image) }}" width="70" />
                @endif
            </td>
            <td>{!! date('F l M Y', strtotime($post->created_at)) !!}</td>
            <td>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary btn-sm">
                        Edit
                    </a>
                    <form action="{{ route('post.delete', $post->id) }}" method="post">
                        @csrf
                        @method("delete")
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">You should create your first blog</td>
        </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3">{{ $items->links() }}</td>
        </tr>
    </tfoot>
</table>
<div>
</div>
@endsection