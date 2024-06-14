@extends('layouts.app')

@section('content')

    @include('partials.titular', ['titular' => __('My posts'), 'subtitulo' => ''])

    @isset($current_compilation)
        <form action="{{ route('editor.select_compilation') }}"
              method="POST">
            <div class="mb-3 d-flex ">
                @csrf
                <label class="col-form-label" for="compilation_id">{{ __('Compilation') }}</label>
                <select class="form-select mx-3" id="compilation_id" name="compilation_id">
                    @foreach($compilations as $compilation)
                        <option {{ $compilation->id == $current_compilation->id ? 'selected' : '' }}
                                value="{{ $compilation->id }}">
                            {{ $compilation->title }}
                        </option>
                    @endforeach
                </select>
                <button name="select-compilation"
                        type="submit"
                        class="btn btn-primary">
                    {{ __('Select') }}
                </button>
            </div>
        </form>

        <h2>{{ $current_compilation->repository->title }} - {{ $current_compilation->title }}</h2>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr class="table-dark">
                    <th>{{ __('Post') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody class="align-middle table-group-divider">
                @foreach ($current_compilation->posts as $post)
                    <tr>
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
                <tfoot class="table-group-divider">
                <tr>
                    <th colspan="5" class="border-0">{{ __('Total') }}: {{ $current_compilation->posts->count() }}</th>
                </tr>
                </tfoot>
            </table>
        </div>
    @else
        <p>{{ __('There are no compilations available.') }}</p>
    @endisset

@endsection
