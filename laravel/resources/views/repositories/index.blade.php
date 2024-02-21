@extends('layouts.app')

@section('content')

    @include('partials.titular', ['titular' => __('My repositories'), 'subtitulo' => ''])

    @can('repository-create')
        <div class="my-3">
            <a class="btn btn-primary" href="{{ route('repositories.create') }}">{{ __('New repository') }}</a>
        </div>
    @endcan

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <span>{{ $message }}</span>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr class="table-dark">
                <th>#</th>
                <th>{{ __('Title') }}</th>
                <th>{{ __('Description') }}</th>
                <th>{{ __('Public') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
            </thead>
            <tbody class="align-middle">
            @foreach ($repositories as $key => $repository)
                <tr>
                    <td>{{ $repository->id }}</td>
                    <td>{{ $repository->title }}</td>
                    <td>{{ $repository->description }}</td>
                    <td>{{ $repository->public ? __('Yes') : __('No') }}</td>
                    <td>
                        <div class="d-flex">
                            @can('repository-edit')
                                <a href="{{ route('repositories.edit', [$repository->id]) }}"
                                   title="{{ __('Edit') }}"
                                   class="btn btn-sm btn-secondary me-2" role="button">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            @endcan
                            @can('repository-delete')
                                <form action="{{ route('repositories.destroy', [$repository->id]) }}" method="POST">
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
                <th colspan="5" class="border-0">{{ __('Total') }}: {{ $repositories->count() }}</th>
            </tr>
            </tfoot>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {!! $repositories->links() !!}
    </div>

@endsection
