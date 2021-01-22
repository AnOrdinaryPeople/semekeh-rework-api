<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ttl = config('app.name', 'SMK BPI');
        $dsc = 'Bermartabat Berkualitas dan Tepercaya';
        $img = asset('img/logo.webp');
        $url = url('/');
        $key = 'SMK BPI, SMK, BPI, RPL, OTKP, TKJ, Berkualitas, Bermartabat, Tepercaya';

        $a = [
            [null, 'application-name', $ttl],
            [null, 'description', $dsc],
            [null, 'image', $img],
            [null, 'keywords', $key],
            [null, 'theme-color', '#022c43'],
            ['google', 'name', $ttl],
            ['google', 'description', $dsc],
            ['google', 'image', $img],
            ['twitter', 'card', 'summary'],
            ['twitter', 'site', '@smkbpibdg'],
            ['twitter', 'title', $ttl],
            ['twitter', 'description', $dsc],
            ['twitter', 'image', $img],
            ['og', 'title', $ttl],
            ['og', 'type', 'website'],
            ['og', 'url', $url],
            ['og', 'image', $img],
            ['og', 'description', $dsc],
            ['og', 'keywords', $key],
        ];

        \App\Models\Meta::truncate();
        foreach($a as $b) \App\Models\Meta::create([
            'type' => $b[0],
            'key' => $b[1],
            'value' => $b[2]
        ]);
    }
}
