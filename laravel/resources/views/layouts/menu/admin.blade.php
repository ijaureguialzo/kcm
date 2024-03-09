@hasrole('admin')
@include('layouts.sidebar.nav-title', [
    'text' => __('User management'),
])
@can('user-list')
    @include('layouts.sidebar.nav-item', [
        'route' => route('users.index'),
        'text' => __('Users'),
        'icon' => 'bi-person',
    ])
@endcan
@can('role-list')
    @include('layouts.sidebar.nav-item', [
        'route' => route('roles.index'),
        'text' => __('Roles'),
        'icon' => 'bi-person-badge',
    ])
@endcan
@can('permission-list')
    @include('layouts.sidebar.nav-item', [
        'route' => route('permissions.index'),
        'text' => __('Permissions'),
        'icon' => 'bi-key',
        'last' => true,
    ])
@endcan
@endhasrole
