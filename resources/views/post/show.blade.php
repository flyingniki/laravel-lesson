@extends('layouts.main')
@section('content')
    <div>
        <div>
            {{ $post->id }}.{{ $post->title }}
        </div>
        <div>
            {{ $post->content }}
        </div>
        <div>
            <a href="{{ route('post.edit', $post->id) }}">Edit</a>
        </div>
        <div>
            <form action="{{ route('post.delete', $post->id) }}" method="post">
                @csrf
                @method('delete')
                <input class="btn btn-danger" type="submit" value="Delete">
            </form>

        </div>
        <div>
            <a href="{{ route('post.index') }}">Back</a>
        </div>
    </div>
@endsection
