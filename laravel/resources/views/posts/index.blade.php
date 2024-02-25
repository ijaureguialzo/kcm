@extends('layouts.app')

@section('content')

    @include('partials.titular', ['titular' => __('My posts'), 'subtitulo' => ''])

    @can('post-create')
        <div class="my-3">
            <a class="btn btn-primary" href="{{ route('posts.create') }}">{{ __('New post') }}</a>
        </div>
    @endcan

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <span>{{ $message }}</span>
        </div>
    @endif

    @foreach ($compilations as $compilation)
        <h2 class="fs-4">{{ $compilation->repository->title }} - {{ $compilation->title }}</h2>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr class="table-dark">
                    <th>#</th>
                    <th>{{ __('Post') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody class="align-middle">
                @foreach ($compilation->posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>
                            @include('posts.summary', ['data' => $post])
                        </td>
                        <td>
                            <div class="d-flex">
                                @can('post-edit')
                                    <a href="{{ route('posts.edit', [$post->id]) }}"
                                       title="{{ __('Edit') }}"
                                       class="btn btn-sm btn-secondary me-2" role="button">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                @endcan
                                @can('post-delete')
                                    <form action="{{ route('posts.destroy', [$post->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button title="{{ __('Delete') }}"
                                                name="delete"
                                                type="submit" onclick="return confirm('{{ __('Are you sure?') }}')"
                                                class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="5" class="border-0">{{ __('Total') }}: {{ $compilation->posts->count() }}</th>
                </tr>
                </tfoot>
            </table>
        </div>
    @endforeach

    <div class="d-flex justify-content-center">
        {!! $compilations->links() !!}
    </div>

@endsection
