@extends('mail.layout')

@section('content')
    <hr>
    <div class="mb-2">
        @foreach ($compilation->posts as $post)
            @include('posts.summary', ['data' => $post])
            <hr>
        @endforeach
    </div>
@endsection
