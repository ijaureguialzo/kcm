<?php

namespace App\Http\Controllers;

use App\Mail\CompilationPublished;
use App\Models\Compilation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CompilationController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:compilation-list', ['only' => ['index']]);
        $this->middleware('permission:compilation-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:compilation-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:compilation-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $compilations = Auth::user()->compilations()->paginate(10);

        return view('compilations.index', compact('compilations'));
    }

    public function create()
    {
        $repositories = Auth::user()->owned_repositories()->get();

        return view('compilations.create', compact('repositories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'published' => 'nullable|date',
        ]);

        Compilation::create([
            'title' => request('title'),
            'published' => request('published'),
            'repository_id' => request('repository_id'),
        ]);

        return redirect(route('compilations.index'));
    }

    public function edit(Compilation $compilation)
    {
        $repositories = Auth::user()->owned_repositories()->get();

        return view('compilations.edit', compact(['compilation', 'repositories']));
    }

    public function update(Request $request, Compilation $compilation)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'published' => 'nullable|date',
        ]);

        $compilation->update([
            'title' => request('title'),
            'published' => request('published'),
            'repository_id' => request('repository_id'),
        ]);

        return redirect(route('compilations.index'));
    }

    public function destroy(Compilation $compilation)
    {
        $compilation->delete();

        return back();
    }

    public function selection_add(Compilation $compilation)
    {
        $this->add_to_session('selected_compilations', $compilation->id);

        return back();
    }

    public function selection_remove(Compilation $compilation)
    {
        $this->remove_from_session('selected_compilations', $compilation->id);

        return back();
    }

    public function selection_clear()
    {
        session()->forget('selected_compilations');

        return back();
    }

    public function publish(Compilation $compilation)
    {
        $compilation->published = now();
        $compilation->save();

        $this->remove_from_session('selected_compilations', $compilation->id);

        $subscribers = $compilation->repository->subscribers;

        foreach ($subscribers as $recipient) {
            Mail::to($recipient->email)->send(new CompilationPublished($compilation));
        }

        return back();
    }

    public function add_to_session(string $key, mixed $value): void
    {
        $seleccionadas = session($key) ?: [];

        $seleccionadas = array_unique(array_merge($seleccionadas, [$value]));

        session()->put($key, $seleccionadas);
    }

    public function remove_from_session(string $key, mixed $value): void
    {
        $seleccionadas = session($key) ?: [];

        $seleccionadas = array_diff($seleccionadas, [$value]);

        session()->put($key, $seleccionadas);
    }
}
