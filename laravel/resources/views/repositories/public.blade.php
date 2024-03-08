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
                <th>{{ __('Title') }}</th>
                <th>{{ __('Description') }}</th>
                <th>{{ __('Editor') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
            </thead>
            <tbody class="align-middle">
            @foreach ($repositories as $key => $repository)
                @php($subscribed = $subscriptions->contains($repository))
                <tr>
                    <td>{{ $repository->title }}</td>
                    <td>{{ $repository->description }}</td>
                    <td>{{ $repository->owner->name }}</td>
                    <td>
                        @if($subscribed)
                            <span class="badge bg-primary">{{ __('Subscribed') }}</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex">
                            @if(!$subscribed)
                                @can('repository-subscribe')
                                    <form action="{{ route('repositories.subscribe', [$repository->id, $user->id]) }}"
                                          method="POST">
                                        @csrf
                                        <button title="{{ __('Subscribe to this repository') }}"
                                                name="subscribe"
                                                type="submit" {{ $subscribed ? 'disabled' : '' }}
                                                class="btn btn-sm {{ $subscribed ? 'btn-secondary' : 'btn-primary' }} me-2">
                                            <i class="bi bi-bookmark-check"></i>
                                        </button>
                                    </form>
                                @endcan
                            @else
                                @can('repository-unsubscribe')
                                    <form action="{{ route('repositories.unsubscribe', [$repository->id, $user->id]) }}"
                                          method="POST">
                                        @csrf
                                        <button title="{{ __('Unsubscribe from this repository') }}"
                                                name="unsubscribe"
                                                type="submit" {{ !$subscribed ? 'disabled' : '' }}
                                                class="btn btn-sm {{ !$subscribed ? 'btn-secondary' : 'btn-danger' }} me-2">
                                            <i class="bi bi-bookmark"></i>
                                        </button>
                                    </form>
                                @endcan
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {!! $repositories->links() !!}
    </div>

@endsection
