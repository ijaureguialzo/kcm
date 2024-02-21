<?php

namespace App\Http\Controllers;

use App\Models\Compilation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompilationController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:compilation-list|compilation-create|compilation-edit|compilation-delete', ['only' => ['index', 'store']]);
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
}
