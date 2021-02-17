<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CacheCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:refresh {timer=month}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh cached database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $timer = timer($this->argument('timer'));

        $this->line('Refreshing the database cache..');

        Cache::flush();

        // Cache::put('meta', [
        //     'data' => \App\Models\Meta::orderBy('id')->get(['type', 'key', 'value'])
        // ], $timer);

        Cache::put('navbar', [
            'bpi' => \App\Models\Keyword::find(1)->value,
            'study' => \App\Models\Study::orderBy('title')->get(['title', 'slug'])
        ], $timer);

        Cache::put('footer', [
            'agenda' => \App\Models\Agenda::latest()->first(['banner', 'title', 'time', 'slug']),
            'footer' => \App\Models\Footer::latest()->get(['key', 'value'])
        ], $timer);

        Cache::put('home', [
            'carousel' => \App\Models\Carousel::oldest()->get(['description', 'title', 'type', 'url']),
            'video' => \App\Models\Video::whereIsPublish(true)->latest()->get(['thumbnail', 'video']),
            'about' => \App\Models\About::whereId(1)->first(['content', 'url']),
            'alumni' => \App\Models\Alumni::whereIsPublish(true)->latest()->get(['company', 'content', 'name', 'url']),
            'company' => \App\Models\Company::latest()->get(['link', 'url']),
            'section' => \App\Models\Section::orderBy('id')->get(['title', 'subtitle']),
            'prestation' => \App\Models\Prestation::latest()->limit(3)->get(['rank', 'title', 'url', 'year']),
            'agenda' => \App\Models\Agenda::latest()->first(['banner', 'content', 'slug', 'time', 'title']),
            'news' => \App\Models\News::latest()->limit(3)->get(['title', 'banner', 'slug', 'created_at'])
        ], timer());

        Cache::put('social', \App\Models\Social::latest()->get(['icon', 'link']), $timer);

        foreach(\App\Models\Profile::all() as $p){
            $obj = [
                'content' => $p,
                'img' => \App\Models\Gallery::whereTarget(1)
                    ->whereType($p->id)
                    ->latest()
                    ->get('url')
            ];

            if($p->id === 3)
                $obj['council'] = \App\Models\Council::whereId(1)->first(['title', 'json']);

            Cache::put('profile'.$p->id, $obj, $timer);
        }

        foreach(\App\Models\Study::all() as $p)
            Cache::put('study'.str_replace('-', '', $p->slug), $p, $timer);

        Cache::put('agenda', \App\Models\Agenda::latest()->get(['slug', 'title', 'time', 'content', 'banner']), $timer);

        Cache::put('news', \App\Models\News::latest()->get(['slug', 'title', 'content', 'banner', 'created_at']), $timer);

        Cache::put('prestation', \App\Models\Prestation::latest()->get(['title', 'rank', 'year', 'url']), $timer);

        Cache::put('gallery', [
            'img' => \App\Models\Gallery::latest('id')->get('url'),
            'video' => \App\Models\Video::latest()->get(['thumbnail', 'video'])
        ], $timer);

        Cache::put('employee', [
            'employee' => \App\Models\Employee::latest()->get(['title', 'name', 'url', 'type', 'child_type']),
            'img' => \App\Models\Gallery::whereTarget(4)
                ->latest()
                ->get('url')
        ], $timer);

        $this->info('Database cache has been refreshed!');

        return 1;
    }
}
