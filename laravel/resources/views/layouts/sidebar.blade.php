<div class="d-flex flex-column p-3 text-bg-dark col-12 col-sm-2">
    @auth
        <ul class="nav nav-pills flex-column mb-auto">
            @include('layouts.menu.editor')
            @include('layouts.menu.admin')
        </ul>
    @endauth
</div>
