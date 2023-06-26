@extends('layouts.main')
@section('content')
<div>
    this is posts page
</div>
<div>
    @foreach($posts as $post)
    {{$post}}
    @endforeach
</div>
@endsection
