@hasrole('subscriber')
@include('layouts.sidebar.nav-title', [
    'text' => __('Subscriber'),
])
@include('layouts.sidebar.nav-item', [
    'route' => route('home'),
    'text' => __('Desktop'),
    'icon' => 'bi-house',
])
@can('repository-list')
    @include('layouts.sidebar.nav-item', [
        'route' => route('repositories.public'),
        'text' => __('Repositories'),
        'icon' => 'bi-archive',
    ])
@endcan
@endhasrole
