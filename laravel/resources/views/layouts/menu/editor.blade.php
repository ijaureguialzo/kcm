@hasrole('editor')
@include('layouts.sidebar.nav-title', [
    'text' => __('Editor'),
])
@include('layouts.sidebar.nav-item', [
    'route' => route('editor.index'),
    'text' => __('Desktop'),
    'icon' => 'bi-house',
])
@can('post-list')
    @include('layouts.sidebar.nav-item', [
        'route' => route('posts.index'),
        'text' => __('My posts'),
        'icon' => 'bi-file-post',
    ])
@endcan
@include('layouts.sidebar.nav-title', [
    'text' => __('Feeds'),
])
@can('feed-list')
    @include('layouts.sidebar.nav-item', [
        'route' => route('feeds.index'),
        'text' => __('My feeds'),
        'icon' => 'bi-rss',
    ])
@endcan
@include('layouts.sidebar.nav-title', [
    'text' => __('Compilations'),
])
@can('repository-list')
    @include('layouts.sidebar.nav-item', [
        'route' => route('repositories.index'),
        'text' => __('My repositories'),
        'icon' => 'bi-archive',
    ])
@endcan
@can('compilation-list')
    @include('layouts.sidebar.nav-item', [
        'route' => route('compilations.index'),
        'text' => __('My compilations'),
        'icon' => 'bi-collection',
    ])
@endcan
@endhasrole
