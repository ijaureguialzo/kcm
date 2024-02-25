<?php

namespace App\Http\Controllers;

use App\Models\Compilation;
use App\Models\Feed;
use App\Models\Item;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditorController extends Controller
{
    public function index()
    {
        $feeds = Auth::user()->feeds()->get();

        $feed_seleccionado = session('selected_feed');

        if (!empty($feed_seleccionado)) {
            $current_feed = Feed::find($feed_seleccionado);
        } else {
            $current_feed = Feed::first();
        }

        if ($current_feed != null) {
            $items = $current_feed->items()->unread()->paginate(10);
        } else {
            $items = [];
        }

        return view('editor.index', compact(['feeds', 'current_feed', 'items']));
    }

    public function mark_item_read(Item $item)
    {
        $item->read = true;
        $item->save();

        return back();
    }

    public function compile_post(Item $item)
    {
        $seleccionadas = session('selected_compilations') ?: [];

        foreach ($seleccionadas as $compilation_id) {
            $compilation = Compilation::findOrFail($compilation_id);

            Post::create([
                'title' => $item->title,
                'description' => $item->description,
                'content' => $item->content,
                'url' => $item->url,
                'compilation_id' => $compilation->id,
            ]);

            $item->read = true;
            $item->save();
        }

        return back();
    }

    public function select_feed()
    {
        $feed_id = request('feed_id');

        $feed = Feed::findOrFail($feed_id);

        session()->put('selected_feed', $feed->id);

        return back();
    }
}
