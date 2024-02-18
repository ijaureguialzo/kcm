@extends('layouts.app')

@section('content')

    @include('partials.titular', ['titular' => __('My feeds'), 'subtitulo' => ''])

    @can('feed-create')
        <div class="my-3">
            <a class="btn btn-primary" href="{{ route('feeds.create') }}">{{ __('New feed') }}</a>
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
                <th>{{ __('URL') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
            </thead>
            <tbody class="align-middle">
            @foreach ($feeds as $key => $feed)
                <tr>
                    <td>{{ $feed->id }}</td>
                    <td>{{ $feed->title }}</td>
                    <td>{{ $feed->url }}</td>
                    <td>
                        <div class="d-flex">
                            @can('feed-edit')
                                <a href="{{ route('feeds.edit', [$feed->id]) }}"
                                   title="{{ __('Edit') }}"
                                   class="btn btn-sm btn-secondary me-2" role="button">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            @endcan
                            @can('feed-delete')
                                <form action="{{ route('feeds.destroy', [$feed->id]) }}" method="POST">
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
                <th colspan="5" class="border-0">{{ __('Total') }}: {{ $feeds->count() }}</th>
            </tr>
            </tfoot>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {!! $feeds->links() !!}
    </div>

@endsection
