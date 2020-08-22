<?php

namespace App\Console\Commands;

use DB;
use App\Models\Offer;
use Illuminate\Console\Command;

class DisableIrrelevantOffers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'offers:disable-irrelevant-offers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        $offers = Offer::withCount('dates')
            ->having('dates_count', '=', 0)
            ->get('id')
            ->pluck('id');
        
        Offer::whereIn('id', $offers)->update([
            'status' => Offer::NO_ACTIVE
        ]);
    }
}
