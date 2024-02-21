@extends('layouts.app')

@section('content')

    @include('partials.titular', ['titular' => __('New repository'), 'subtitulo' => ''])

    <form action="{{ route('repositories.store') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <label class="col-2 form-label" for="title">{{ __('Title') }}</label>
            <div class="col-10">
                <input class="form-control" type="text" id="title" name="title" placeholder=""
                       value="{{ old('title') }}"/>
                <span class="text-danger">{{ $errors->first('title') }}</span>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-2 form-label" for="description">{{ __('Description') }}</label>
            <div class="col-10">
                <input class="form-control" type="text" id="description" name="description" placeholder=""
                       value="{{ old('description') }}"/>
                <span class="text-danger">{{ $errors->first('description') }}</span>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-2 form-label" for="public">{{ __('Public') }}</label>
            <div class="col-10">
                <input class="form-check-input" type="checkbox" id="public" name="public"
                    {{ old('public') ? 'checked' : '' }}>
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
