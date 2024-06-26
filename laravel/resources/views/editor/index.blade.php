@extends('layouts.app')

@section('content')

    @include('partials.titular', ['titular' => __('Desktop'), 'subtitulo' => ''])

    @isset($current_feed)
        <form action="{{ route('editor.select_feed') }}"
              method="POST">
            <div class="mb-3 d-flex ">
                @csrf
                <label class="col-form-label" for="feed_id">{{ __('Feed') }}</label>
                <select class="form-select mx-3" id="feed_id" name="feed_id">
                    @foreach($feeds as $feed)
                        <option {{ $feed->id == $current_feed->id ? 'selected' : '' }}
                                value="{{ $feed->id }}">
                            {{ $feed->title }}
                        </option>
                    @endforeach
                </select>
                <button name="select-feed"
                        type="submit"
                        class="btn btn-primary">
                    {{ __('Select') }}
                </button>
            </div>
        </form>

        <h2>{{ $current_feed->title }}</h2>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr class="table-dark">
                    <th>{{ __('Item') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody class="align-middle table-group-divider">
                @foreach ($items as $item)
                    <tr>
                        <td>
                            @include('posts.summary', ['data' => $item])
                        </td>
                        <td>
                            <div class="d-flex">
                                @session('selected_compilations')
                                @if(count($value) > 0)
                                    <form action="{{ route('editor.compile_post', [$item->id]) }}"
                                          method="POST">
                                        @csrf
                                        <button title="{{ __('Add to selected compilations') }}"
                                                name="compile-post"
                                                type="submit"
                                                class="btn btn-sm btn-primary me-2">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                    </form>
                                @endif
                                @endsession
                                <form action="{{ route('editor.mark_item_read', [$item->id]) }}"
                                      method="POST">
                                    @csrf
                                    <button title="{{ __('Mark as read') }}"
                                            name="mark-read"
                                            type="submit"
                                            class="btn btn-sm btn-secondary me-2">
                                        <i class="bi bi-check2"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot class="table-group-divider">
                <tr>
                    <th class="border-0">{{ __('Total') }}: {{ $items_total }}</th>
                </tr>
                </tfoot>
            </table>
        </div>

        <div class="text-center">
            <form action="{{ route('editor.mark_all_item_read') }}"
                  method="POST">
                @csrf
                <input type="hidden" name="item_ids" value="{{ $items->pluck('id') }}"/>
                <button name="mark-all-read"
                        type="submit"
                        class="btn btn-secondary mb-5">
                    <i class="bi bi-check2-all"></i><span class="ms-2">{{ __('Mark all as read') }}</span>
                </button>
            </form>
        </div>

        <div class="d-flex justify-content-center">
            {!! $items->links() !!}
        </div>
    @else
        <p>{{ __('There are no feeds available.') }}</p>
    @endisset

@endsection
