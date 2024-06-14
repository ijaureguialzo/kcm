@extends('layouts.app')

@section('content')

    <h2>{{ __('Most recent compilation') }}</h2>
    @isset($most_recent)
        @include('partials.titular', ['titular' => $most_recent->repository->title, 'subtitulo' => ''])

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <span>{{ $message }}</span>
            </div>
        @endif

        <h2>{{ $most_recent->title }}</h2>
        <div class="table-responsive">
            <table class="table table-hover">
                <tbody class="align-middle">
                @foreach ($most_recent->posts as $post)
                    <tr>
                        <td>
                            @include('posts.summary', ['data' => $post])
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>{{ __('There is no compilation available.') }}</p>
    @endisset

    <h2>{{ __('Previous compilations') }}</h2>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr class="table-dark">
                <th>{{ __('Title') }}</th>
                <th>{{ __('Posts') }}</th>
                <th>{{ __('Published') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
            </thead>
            <tbody class="align-middle">
            @foreach ($compilations as $key => $compilation)
                <tr>
                    <td>{{ $compilation->title }}</td>
                    <td>{{ $compilation->posts->count() }}</td>
                    <td>
                        @include('compilations.fecha_publicacion')
                    </td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('subscriptions.show', $compilation->id) }}"
                               class="btn btn-sm btn-secondary" role="button">
                                <i class="bi bi-eye"></i><span class="ms-2">{{ __('View compilation') }}</span>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {!! $compilations->links() !!}
    </div>

    <div>
        <a href="{{ route('subscriptions.index') }}"
           class="btn btn-sm btn-secondary" role="button">
            <i class="bi bi-arrow-left"></i><span class="ms-2">{{ __('Back to subscriptions list') }}</span>
        </a>
    </div>

@endsection
