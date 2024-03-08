@extends('layouts.app')

@section('content')

    @include('partials.titular', ['titular' => __('My subscriptions'), 'subtitulo' => ''])

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <span>{{ $message }}</span>
        </div>
    @endif

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($repositories as $key => $repository)
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $repository->title }}</h5>
                        <p class="card-text">{{ $repository->description }}</p>
                        <p class="card-text">{{ __('Curated by') }}: {{ $repository->owner->name }}</p>
                    </div>
                    <div class="card-body text-end">
                        <a href="#"
                           class="btn btn-sm btn-primary me-2" role="button">
                            <i class="bi bi-eye"></i><span class="ms-2">{{ __('View compilations') }}</span>
                        </a>
                    </div>
                    <div class="card-footer">
                        <small class="text-body-secondary">
                            {{ __(':number subscribers.', ['number' => $repository->subscribers->count()]) }}
                        </small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
