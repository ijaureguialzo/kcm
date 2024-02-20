@extends('layouts.app')

@section('content')

    @include('partials.titular', ['titular' => __('Desktop'), 'subtitulo' => ''])

    <h2>{{ $feed->title }}</h2>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr class="table-dark">
                <th class="small">{{ __('Item') }}</th>
                <th class="small">{{ __('Actions') }}</th>
            </tr>
            </thead>
            <tbody class="align-middle table-group-divider">
            @foreach ($items as $item)
                <tr>
                    <td>
                        <div>
                            <p class="fw-bold small m-0">{{ $item->title }}</p>
                            <p class="small m-0">{{ $item->description }}</p>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ $item->url }}"
                               target="_blank"
                               title="{{ __('View original entry') }}"
                               class="btn btn-sm btn-secondary me-2" role="button">
                                <i class="bi bi-link"></i>
                            </a>
                            <a href="#"
                               title="{{ __('Add to bucket') }}"
                               class="btn btn-sm btn-primary me-2" role="button">
                                <i class="bi bi-plus-lg"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot class="table-group-divider">
            <tr>
                <th colspan="5" class="border-0">{{ __('Total') }}: {{ $items->count() }}</th>
            </tr>
            </tfoot>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {!! $items->links() !!}
    </div>

@endsection
