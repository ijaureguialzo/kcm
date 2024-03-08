<div>
    <p class="fw-bold small m-0">{{ $data->title }}</p>
    <p class="small m-0">{{ $data->description }}</p>
    <p class="m-0">
        <a class="small m-0 hover-link" href="{{ $data->url }}"
           target="_blank">
            {{ __('View original source') }}
        </a>
    </p>
</div>
