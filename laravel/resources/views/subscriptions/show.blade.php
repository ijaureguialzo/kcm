@extends('layouts.app')

@section('content')

    @include('partials.titular', ['titular' => $compilation->repository->title, 'subtitulo' => ''])

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <span>{{ $message }}</span>
        </div>
    @endif

    <h2>{{ $compilation->title }}</h2>
    <div class="table-responsive">
        <table class="table table-hover">
            <tbody class="align-middle">
            @foreach ($compilation->posts as $post)
                <tr>
                    <td>
                        @include('posts.summary', ['data' => $post])
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div>
        <a href="{{ route('subscriptions.compilations', $compilation->repository->id) }}"
           class="btn btn-sm btn-secondary" role="button">
            <i class="bi bi-arrow-left"></i><span class="ms-2">{{ __('Back to compilations list') }}</span>
        </a>
    </div>

@endsection
