<?php

namespace App\Http\Controllers;

use App\Models\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepositoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:repository-list|repository-create|repository-edit|repository-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:repository-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:repository-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:repository-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $repositories = Auth::user()->owned_repositories()->paginate(10);

        return view('repositories.index', compact('repositories'));
    }

    public function create()
    {
        return view('repositories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
        ]);

        Repository::create([
            'title' => request('title'),
            'description' => request('description'),
            'public' => request()->has('public'),
            'user_id' => Auth::user()->id,
        ]);

        return redirect(route('repositories.index'));
    }

    public function edit(Repository $repository)
    {
        return view('repositories.edit', compact('repository'));
    }

    public function update(Request $request, Repository $repository)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
        ]);

        $repository->update([
            'title' => request('title'),
            'description' => request('description'),
            'public' => request()->has('public'),
        ]);

        return redirect(route('repositories.index'));
    }

    public function destroy(Repository $repository)
    {
        $repository->delete();

        return back();
    }
}