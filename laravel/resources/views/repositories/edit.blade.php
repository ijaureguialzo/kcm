@extends('layouts.app')

@section('content')

    @include('partials.titular', ['titular' => __('Edit repository'), 'subtitulo' => ''])

    <form action="{{ route('repositories.update', [$repository->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row mb-3">
            <label class="col-2 form-label" for="title">{{ __('Title') }}</label>
            <div class="col-10">
                <input class="form-control" type="text" id="title" name="title" placeholder=""
                       value="{{ old('title') ?: $repository->title }}"/>
                <span class="text-danger">{{ $errors->first('title') }}</span>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-2 form-label" for="description">{{ __('Description') }}</label>
            <div class="col-10">
                <input class="form-control" type="text" id="description" name="description" placeholder=""
                       value="{{ old('description') ?: $repository->description }}"/>
                <span class="text-danger">{{ $errors->first('description') }}</span>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-2 form-label" for="public">{{ __('Public') }}</label>
            <div class="col-10">
                <input type="hidden" name="public-isset" value="1">
                <input class="form-check-input" type="checkbox" id="public" name="public" value="1"
                    {{ old('public-isset') ? (old('public') ? 'checked' : '') : ($repository->public ? 'checked' : '') }}>
                <span class="text-danger">{{ $errors->first('public') }}</span>
            </div>
        </div>
        <div class="mt-5">
            <input class="btn btn-primary" type="submit" name="guardar" value="{{ __('Save') }}"/>
            <a class="btn btn-link link-secondary link-underline-opacity-0 link-underline-opacity-100-hover ms-2"
               href="{{ route('repositories.index') }}">{{ __('Cancel') }}</a>
        </div>
    </form>

@endsection
