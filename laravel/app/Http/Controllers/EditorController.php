<?php

namespace App\Http\Controllers;

use App\Models\Compilation;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class EditorController extends Controller
{
    public function index()
    {
        $feed = Auth::user()->feeds()->firstOrFail();

        $items = $feed->items()->unread()->paginate(10);

        return view('editor.index', compact(['feed', 'items']));
    }

    public function mark_item_read(Item $item)
    {
        $item->read = true;
        $item->save();

        return back();
    }

    public function compile_post(Compilation $compilation, Item $item)
    {
        return back();
    }
}
