@hasrole('editor')
@include('layouts.sidebar.nav-title', [
    'text' => __('Editor'),
])
@include('layouts.sidebar.nav-item', [
    'route' => route('home'),
    'text' => __('Home'),
    'icon' => 'bi-house',
])
@include('layouts.sidebar.nav-item', [
    'route' => route('editor.index'),
    'text' => __('Desktop'),
    'icon' => 'bi-newspaper',
])
@include('layouts.sidebar.nav-item', [
    'route' => route('editor.refresh'),
    'text' => __('Refresh'),
    'icon' => 'bi-arrow-clockwise',
])
@can('feed-list')
    @include('layouts.sidebar.nav-item', [
        'route' => route('feeds.index'),
        'text' => __('My feeds'),
        'icon' => 'bi-rss',
    ])
@endcan
@include('layouts.sidebar.nav-separator')
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
@can('post-list')
    @include('layouts.sidebar.nav-item', [
        'route' => route('posts.index'),
        'text' => __('My posts'),
        'icon' => 'bi-file-post',
    ])
@endcan
@endhasrole
