<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Specialty;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class RemoveOldOffersDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'offers:send-email-to-executors';

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
        $speciality = Specialty::all();

        dd($speciality);
    }
}
