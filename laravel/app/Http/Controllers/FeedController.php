<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:feed-list|feed-create|feed-edit|feed-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:feed-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:feed-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:feed-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $feeds = Auth::user()->feeds()->paginate(config('kcm.default_pagination'));

        return view('feeds.index', compact('feeds'));
    }

    public function create()
    {
        return view('feeds.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'url' => 'required|max:255|url:http,https',
        ]);

        Feed::create([
            'title' => request('title'),
            'url' => request('url'),
            'user_id' => Auth::user()->id,
        ]);

        return redirect(route('feeds.index'));
    }

    public function edit(Feed $feed)
    {
        return view('feeds.edit', compact('feed'));
    }

    public function update(Request $request, Feed $feed)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'url' => 'required|max:255|url:http,https',
        ]);

        $feed->update([
            'title' => request('title'),
            'url' => request('url'),
        ]);

        return redirect(route('feeds.index'));
    }

    public function destroy(Feed $feed)
    {
        if (session('selected_feed') == $feed->id) {
            session()->forget('selected_feed');
        }

        $feed->delete();

        return back();
    }
}
