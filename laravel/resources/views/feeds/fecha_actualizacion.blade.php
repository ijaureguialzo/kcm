<span title="{{ $feed->last_refreshed?->isoFormat('LL LTS') ?: '' }}">
    {{ $feed->last_refreshed?->diffForHumans() ?: __('Not loaded yet') }}
</span>
