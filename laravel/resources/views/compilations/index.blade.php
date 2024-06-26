@extends('layouts.app')

@section('content')

    @include('partials.titular', ['titular' => __('My compilations'), 'subtitulo' => ''])

    @can('compilation-create')
        <div class="my-3">
            <a class="btn btn-primary" href="{{ route('compilations.create') }}">{{ __('New compilation') }}</a>
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
                <th>{{ __('Repository') }}</th>
                <th>{{ __('Title') }}</th>
                <th>{{ __('Posts') }}</th>
                <th>{{ __('Published') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
            </thead>
            <tbody class="align-middle table-group-divider">
            @foreach ($compilations as $key => $compilation)
                <tr>
                    <td>{{ $compilation->repository->title }}</td>
                    <td>{{ $compilation->title }}</td>
                    <td>{{ $compilation->posts->count() }}</td>
                    <td>
                        @include('compilations.fecha_publicacion')
                    </td>
                    <td>
                        <div class="d-flex">
                            @empty($compilation->published)
                                <form action="{{ route('compilations.selection.add', [$compilation->id]) }}"
                                      method="POST">
                                    @csrf
                                    <button title="{{ __('Add to selected compilations') }}"
                                            name="add-compilation"
                                            type="submit"
                                            class="btn btn-sm btn-primary me-2">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                </form>
                            @endempty
                            @empty($compilation->published)
                                <form action="{{ route('compilations.publish', [$compilation->id]) }}"
                                      method="POST">
                                    @csrf
                                    <button title="{{ __('Publish compilation') }}"
                                            name="publish-compilation"
                                            type="submit" onclick="return confirm('{{ __('Are you sure?') }}')"
                                            class="btn btn-sm btn-success me-2">
                                        <i class="bi bi-send"></i>
                                    </button>
                                </form>
                            @endempty
                            @can('compilation-edit')
                                <a href="{{ route('compilations.edit', [$compilation->id]) }}"
                                   title="{{ __('Edit') }}"
                                   class="btn btn-sm btn-secondary me-2" role="button">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            @endcan
                            @can('compilation-delete')
                                <form action="{{ route('compilations.destroy', [$compilation->id]) }}" method="POST">
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
            <tfoot class="table-group-divider">
            <tr>
                <th colspan="5" class="border-0">{{ __('Total') }}: {{ $compilations->count() }}</th>
            </tr>
            </tfoot>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {!! $compilations->links() !!}
    </div>

@endsection
