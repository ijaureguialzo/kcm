@extends('layouts.app')

@section('content')

    @include('partials.titular', ['titular' => __('Repositories'), 'subtitulo' => ''])

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
                <th>{{ __('Editor') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
            </thead>
            <tbody class="align-middle">
            @foreach ($repositories as $key => $repository)
                <tr>
                    <td>{{ $repository->id }}</td>
                    <td>{{ $repository->title }}</td>
                    <td>{{ $repository->description }}</td>
                    <td>{{ $repository->owner->name }}</td>
                    <td>
                        <div class="d-flex">
                            @php($subscribed = $user->subscribed_repositories()->get()->contains($repository))
                            @can('repository-subscribe')
                                <form action="{{ route('repositories.subscribe', [$repository->id, $user->id]) }}"
                                      method="POST">
                                    @csrf
                                    <button title="{{ __('Subscribe to this repository') }}"
                                            name="subscribe"
                                            type="submit" {{ $subscribed ? 'disabled' : '' }}
                                            class="btn btn-sm {{ $subscribed ? 'btn-secondary' : 'btn-primary' }} me-2">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                </form>
                            @endcan
                            @can('repository-unsubscribe')
                                <form action="{{ route('repositories.unsubscribe', [$repository->id, $user->id]) }}"
                                      method="POST">
                                    @csrf
                                    <button title="{{ __('Unsubscribe from this repository') }}"
                                            name="unsubscribe"
                                            type="submit" {{ !$subscribed ? 'disabled' : '' }}
                                            class="btn btn-sm {{ !$subscribed ? 'btn-secondary' : 'btn-primary' }} me-2">
                                        <i class="bi bi-dash-lg"></i>
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
