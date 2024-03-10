@extends('layouts.app')

@section('content')

    @include('partials.titular', ['titular' => __('Edit post'), 'subtitulo' => ''])

    <form action="{{ route('posts.update', [$post->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row mb-3">
            <label class="col-2 form-label" for="compilation_id">{{ __('Compilation') }}</label>
            <div class="col-10">
                <input type="hidden" name="compilation_id-isset" value="1">
                <select class="form-select" id="compilation_id" name="compilation_id">
                    @foreach($compilations as $compilation)
                        <option
                            {{ old('compilation_id-isset') ? (old('compilation_id') == $compilation->id ? 'selected' : '') : ($post->compilation->id  == $compilation->id ? 'selected' : '') }}
                            value="{{ $compilation->id }}">
                            {{ $compilation->title }}
                        </option>
                    @endforeach
                </select>
                <span class="text-danger">{{ $errors->first('compilation_id') }}</span>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-2 form-label" for="title">{{ __('Title') }}</label>
            <div class="col-10">
                <input class="form-control" type="text" id="title" name="title" placeholder=""
                       value="{{ old('title') ?: $post->title }}"/>
                <span class="text-danger">{{ $errors->first('title') }}</span>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-2 form-label" for="description">{{ __('Description') }}</label>
            <div class="col-10">
                <textarea class="form-control" rows="3" style="height:200px;" id="description" name="description">
                    {{ old('description') ?: $post->description }}
                </textarea>
                <span class="text-danger">{{ $errors->first('description') }}</span>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-2 form-label" for="content">{{ __('Content') }}</label>
            <div class="col-10">
                <input class="form-control" type="text" id="content" name="content" placeholder=""
                       value="{{ old('content') ?: $post->content }}"/>
                <span class="text-danger">{{ $errors->first('content') }}</span>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-2 form-label" for="url">{{ __('URL') }}</label>
            <div class="col-10">
                <input class="form-control" type="text" id="url" name="url" placeholder=""
                       value="{{ old('url') ?: $post->url }}"/>
                <span class="text-danger">{{ $errors->first('url') }}</span>
            </div>
        </div>
        <div class="mt-5">
            <input class="btn btn-primary" type="submit" name="guardar" value="{{ __('Save') }}"/>
            <a class="btn btn-link link-secondary link-underline-opacity-0 link-underline-opacity-100-hover ms-2"
               href="{{ route('posts.index') }}">{{ __('Cancel') }}</a>
        </div>
    </form>

    <script type="module">
        $('#description').trumbowyg({
            lang: '{{ app()->getLocale() }}'
        });
    </script>
@endsection

@section('trumbowyg')
    @include('partials.trumbowyg')
@endsection
