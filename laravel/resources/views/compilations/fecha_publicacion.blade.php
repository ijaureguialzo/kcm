<span title="{{ $compilation->published?->isoFormat('LL LTS') ?: '' }}">
    {{ $compilation->published?->diffForHumans() ?: __('No') }}
</span>
