<?php

namespace App\Console\Commands;

use App\Models\Schedule;
use Carbon\Carbon;
use Facades\Services\WhatsappService;
use Illuminate\Console\Command;

class WhatsappSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'whatsapp:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Whatsapp schedule broadcast';

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
        $schedules = Schedule::whereDate('sent_at', '<=', Carbon::now())
        ->where('status', 0)
        ->get();

        foreach($schedules as $schedule)
        {
            WhatsappService::broadcast($schedule->message, $schedule->media);

            $schedule->update([
                'status' => 1,
            ]);
        }

        return true;
    }
}
