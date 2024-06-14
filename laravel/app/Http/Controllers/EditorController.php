<?php

namespace App\Http\Controllers;

use App\Models\Compilation;
use App\Models\Feed;
use App\Models\Item;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
            $items = $current_feed->items()->unread()->paginate(config('kcm.feeds_pagination'));
            $items_total = $current_feed->items()->unread()->count();
        } else {
            $items = [];
            $items_total = 0;
        }

        return view('editor.index', compact(['feeds', 'current_feed', 'items', 'items_total']));
    }

    public function mark_item_read(Item $item)
    {
        $item->update(['read' => true]);

        return back();
    }

    public function mark_all_item_read(Request $request)
    {
        $item_ids = $request->input('item_ids');
        $item_ids = Str::replaceStart('[', '', $item_ids);
        $item_ids = Str::replaceEnd(']', '', $item_ids);
        $item_ids = explode(',', $item_ids);

        $items = Item::whereIn('id', $item_ids);

        $items->update(['read' => true]);

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

            $item->update(['read' => true]);
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

    public function select_compilation()
    {
        $compilation_id = request('compilation_id');

        $compilation = Compilation::findOrFail($compilation_id);

        session()->put('selected_compilation', $compilation->id);

        return back();
    }
}
