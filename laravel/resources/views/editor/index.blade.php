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
                            <p class="m-0">
                                <a class="small m-0 hover-link" href="{{ $item->url }}"
                                   target="_blank">
                                    {{ __('View original entry') }}
                                </a>
                            </p>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <form action="{{ route('editor.mark_item_read', [$item->id]) }}"
                                  method="POST">
                                @csrf
                                <button title="{{ __('Mark as read') }}"
                                        name="mark-read"
                                        type="submit"
                                        class="btn btn-sm btn-secondary me-2">
                                    <i class="bi bi-check2"></i>
                                </button>
                            </form>
                            <form action="{{ route('editor.compile_post', [$item->id]) }}"
                                  method="POST">
                                @csrf
                                <button title="{{ __('Add to selected compilations') }}"
                                        name="compile-post"
                                        type="submit"
                                        class="btn btn-sm btn-primary me-2">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </form>
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
