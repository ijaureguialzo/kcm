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

    public function refresh()
    {
        $feeds = Auth::user()->feeds()->get();

        foreach ($feeds as $feed) {

            $intervalo = $feed->refresh_interval ?: 60;

            if (now()->subtract('minutes', $intervalo) > $feed->last_refreshed) {

                $rss = FeedReader::read($feed->url);

                foreach ($rss->get_items() as $item) {
                    try {
                        Item::create([
                            'title' => Str::of($item->get_title())->stripTags()->limit(255),
                            'description' => Str::of($item->get_description())->stripTags(),
                            'content' => Str::of($item->get_content())->stripTags(),
                            'url' => $item->get_link(),
                            'uid' => $item->get_id(true),
                            'published' => Carbon::parse($item->get_gmdate('c')),
                            'feed_id' => $feed->id,
                        ]);
                    } catch (UniqueConstraintViolationException $e) {
                        Log::debug("Item repetido");
                    }
                }

                $feed->last_refreshed = now();
                $feed->save();
            } else {
                Log::debug("No han pasado $intervalo minutos");
            }
        }

        return back();
    }
}
