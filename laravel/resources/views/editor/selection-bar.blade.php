@if(session()->has('selected_compilations') && count(session('selected_compilations')) > 0)
    <nav class="mb-3">
        <span class="fw-bold text-uppercase me-2" style="font-size: .75em;">{{ __('Selected compilations') }}</span>
        @foreach(session('selected_compilations') as $compilation_id)
            <span
                class="badge rounded-pill text-bg-secondary me-2 ps-3 pe-2 d-inline-flex align-items-center justify-content-center">
            {{ \App\Models\Compilation::find($compilation_id)->title }}
            <form action="{{ route('compilations.selection.remove', [$compilation_id]) }}" method="POST">
                @csrf
                <button title="{{ __('Remove from selected compilations') }}"
                        name="remove-compilation"
                        type="submit"
                        class="btn p-0 m-0 ms-2">
                    <i class="bi bi-x-circle fs-6 text-light"></i>
                </button>
            </form>
        </span>
        @endforeach
        <span class="d-inline-flex">
            <form action="{{ route('compilations.selection.clear') }}" method="POST">
                @csrf
                <button title="{{ __('Clear selected compilations') }}"
                        name="clear-compilation"
                        type="submit" onclick="return confirm('{{ __('Are you sure?') }}')"
                        class="btn btn-link p-0 m-0 fw-bold text-uppercase text-light hover-link"
                        style="font-size: .75em;">
                    {{ __('Clear') }}
                </button>
            </form>
        </span>
    </nav>
@endif
