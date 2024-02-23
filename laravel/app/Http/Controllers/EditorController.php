<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Vedmant\FeedReader\Facades\FeedReader;

class EditorController extends Controller
{
    public function index()
    {
        $feed = Auth::user()->feeds()->firstOrFail();

        $items = $feed->items()->paginate(10);

        return view('editor.index', compact(['feed', 'items']));
    }
}
