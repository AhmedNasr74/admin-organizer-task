<?php

namespace App\Console\Commands;

use App\Event;
use App\Events\CheckPendingEvents;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Symfony\Component\Console\Output\ConsoleOutput;

class pending_events extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pending_events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify Admin With Pending Events';

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
        $out = new ConsoleOutput();
        $events = Event::with('organizer')
            ->where('status' , 0)
            ->whereDate('created_at' ,'<=' , Carbon::now()->subHour())
            ->get();
        if ($events->count() > 0 ){
            event(new CheckPendingEvents($events));
            $out->writeln($events->count()." Events");
        } else{
            $out->writeln("No Pending Events");
        }
    }
}
