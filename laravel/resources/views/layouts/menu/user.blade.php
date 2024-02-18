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
    'route' => route('feeds.index'),
    'text' => __('My feeds'),
    'icon' => 'bi-rss',
])
