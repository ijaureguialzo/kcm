<?php

namespace App\Console\Commands;

use App\Models\Feed;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Vedmant\FeedReader\Facades\FeedReader;

class UpdateFeeds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-feeds';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualizar los feeds RSS desde Internet';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $feeds = Feed::all();

        Log::debug("Actualizando feeds", [
            'num_feeds' => $feeds->count(),
        ]);

        foreach ($feeds as $feed) {

            $intervalo = $feed->refresh_interval ?: 60;

            if (now()->subtract('minutes', $intervalo) > $feed->last_refreshed) {

                $rss = FeedReader::read($feed->url);

                if (is_null($rss->error)) {
                    foreach ($rss->get_items() as $item) {
                        try {
                            Item::create([
                                'title' => Str::of($item->get_title())->stripTags()->limit(255),
                                'description' => Str::of($item->get_description())->stripTags('<p>'),
                                'content' => Str::of($item->get_content())->stripTags('<p><a>'),
                                'url' => $item->get_link(),
                                'uid' => $item->get_id(true),
                                'published' => Carbon::parse($item->get_gmdate('c')),
                                'feed_id' => $feed->id,
                            ]);
                        } catch (UniqueConstraintViolationException $e) {
                            Log::debug("Item repetido", [
                                'feed' => $feed->id,
                            ]);
                        }
                    }

                    $feed->update(['last_refreshed' => now()]);
                }
            } else {
                Log::debug("No han pasado $intervalo minutos", [
                    'feed' => $feed->id,
                ]);
            }
        }
    }
}
