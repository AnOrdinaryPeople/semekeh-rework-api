<?php

namespace App\Console\Commands;

use App\Models\History;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class ClearHistoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'history:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete cache history';

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
        $this->line('Deleting..');

        $latest = History::latest()->first();

        History::whereBetween('created_at', [
            (new Carbon())->format('Y-m-d').' 00:00:00',
            (new Carbon('-1 month'))->format('Y-m-d').' 23:59:59'
        ])
            ->where('id', '!=', $latest->id)
            ->delete();

        $this->info('Cache history has been deleted!');

        return 1;
    }
}
