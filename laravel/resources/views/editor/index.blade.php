@extends('layouts.app')

@section('content')

    @include('partials.titular', ['titular' => __('Desktop'), 'subtitulo' => ''])

    <h2>{{ $feed->title }}</h2>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr class="table-dark">
                <th>{{ __('Title') }}</th>
                <th>{{ __('Description') }}</th>
                <th>{{ __('Link') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
            </thead>
            <tbody class="align-middle">
            @foreach ($rss->get_items() as $item)
                <tr>
                    <td>{{ $item->get_title() }}</td>
                    <td>{{ $item->get_description() }}</td>
                    <td>
                        <a class="link-primary link-underline-opacity-0 link-underline-opacity-100-hover" href="{{ $item->get_link() }}">{{ __('Click here') }}</a>
                    </td>
                    <td>
                        <a href="#"
                           title="{{ __('Add to bucket') }}"
                           class="btn btn-sm btn-primary me-2" role="button">
                            <i class="bi bi-plus-lg"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th colspan="5" class="border-0">{{ __('Total') }}: {{ count($rss->get_items()) }}</th>
            </tr>
            </tfoot>
        </table>
    </div>

    {{--
        <div class="d-flex justify-content-center">
            {!! $users->links() !!}
        </div>
    --}}

@endsection
