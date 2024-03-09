<div class="mt-4 px-4 pt-4 pb-1 m-0 bg-secondary-subtle">
    @include('partials.titular', ['titular' => $compilation->full_name, 'subtitulo' => __('Published') . ': ' . $compilation->published->isoFormat('LL LTS')])
</div>
<p class="mx-4 my-3 small">{{ __('Content selected by') }}: {{ $compilation->repository->owner->name }}</p>
