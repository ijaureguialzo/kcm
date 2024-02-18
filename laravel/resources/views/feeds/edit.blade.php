@extends('layouts.app')

@section('content')

    @include('partials.titular', ['titular' => __('Edit feed'), 'subtitulo' => ''])

    <form action="{{ route('feeds.update', [$feed->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row mb-3">
            <label class="col-2 form-label" for="title">{{ __('Title') }}</label>
            <div class="col-10">
                <input class="form-control" type="text" id="title" name="title" placeholder=""
                       value="{{ old('title') ?: $feed->title }}"/>
                <span class="text-danger">{{ $errors->first('title') }}</span>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-2 form-label" for="url">{{ __('URL') }}</label>
            <div class="col-10">
                <input class="form-control" type="text" id="url" name="url" placeholder=""
                       value="{{ old('url') ?: $feed->url }}"/>
                <span class="text-danger">{{ $errors->first('url') }}</span>
            </div>
        </div>
        <div class="mt-5">
            <input class="btn btn-primary" type="submit" name="guardar" value="{{ __('Save') }}"/>
            <a class="btn btn-link link-secondary link-underline-opacity-0 link-underline-opacity-100-hover ms-2"
               href="{{ route('feeds.index') }}">{{ __('Cancel') }}</a>
        </div>
    </form>

@endsection
