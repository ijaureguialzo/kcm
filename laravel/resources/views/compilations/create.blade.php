@extends('layouts.app')

@section('content')

    @include('partials.titular', ['titular' => __('New compilation'), 'subtitulo' => ''])

    <form action="{{ route('compilations.store') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <label class="col-2 form-label" for="repository_id">{{ __('Repository') }}</label>
            <div class="col-10">
                <select class="form-select" id="repository_id" name="repository_id">
                    @foreach($repositories as $repository)
                        <option {{ old('repository_id') == $repository->id ? 'selected' : '' }}
                                value="{{ $repository->id }}">
                            {{ $repository->title }}
                        </option>
                    @endforeach
                </select>
                <span class="text-danger">{{ $errors->first('repository_id') }}</span>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-2 form-label" for="title">{{ __('Title') }}</label>
            <div class="col-10">
                <input class="form-control" type="text" id="title" name="title" placeholder=""
                       value="{{ old('title') }}"/>
                <span class="text-danger">{{ $errors->first('title') }}</span>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-2 form-label" for="published">{{ __('Published') }}</label>
            <div class="col-10">
                <input class="form-control" type="text" id="published" name="published" placeholder=""
                       value="{{ old('published') }}"/>
                <span class="text-danger">{{ $errors->first('published') }}</span>
            </div>
        </div>
        <div class="mt-5">
            <input class="btn btn-primary" type="submit" name="guardar" value="{{ __('Save') }}"/>
            <a class="btn btn-link link-secondary link-underline-opacity-0 link-underline-opacity-100-hover ms-2"
               href="{{ route('compilations.index') }}">{{ __('Cancel') }}</a>
        </div>
    </form>

@endsection
