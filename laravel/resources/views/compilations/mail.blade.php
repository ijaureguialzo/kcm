<div>
    @foreach ($compilation->posts as $post)
        @include('posts.summary', ['data' => $post])
    @endforeach
</div>
