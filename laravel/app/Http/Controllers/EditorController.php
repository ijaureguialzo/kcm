<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vedmant\FeedReader\Facades\FeedReader;

class EditorController extends Controller
{
    public function index()
    {
        $feed = Auth::user()->feeds()->firstOrFail();

        $rss = FeedReader::read($feed->url);

        return view('editor.index', compact(['feed', 'rss']));
    }
}
