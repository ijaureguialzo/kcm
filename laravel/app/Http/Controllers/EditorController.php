<?php

namespace App\Http\Controllers;

use App\Models\Compilation;
use App\Models\Item;
use App\Models\Post;
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
}
