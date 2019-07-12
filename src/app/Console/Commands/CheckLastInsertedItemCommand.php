<?php

namespace App\Console\Commands;

use App\BounceEvent;
use App\ClickEvent;
use App\DeferredEvent;
use App\DeliveredEvent;
use App\DroppedEvent;
use App\OpenEvent;
use App\ProcessedEvent;
use App\SpamReportEvent;
use App\UnsubscribeEvent;
use Illuminate\Console\Command;
use App\Http\Controllers\EventController;

class CheckLastInsertedItemCommand extends Command
{
	/**
	 * List of event models to check
	 *
	 * @var array
	 */
	static $eventModels = [
		BounceEvent::class,
		ClickEvent::class,
		DeferredEvent::class,
		DeliveredEvent::class,
		DroppedEvent::class,
		OpenEvent::class,
		ProcessedEvent::class,
		SpamReportEvent::class,
		UnsubscribeEvent::class
	];
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:lastinserted';

    /**
     * The console command description.
     *CheckLastItemCommand
     * @var string
     */
    protected $description = 'Check database for last time a record was inserted and send an alert email if an error is indicated';


	/**
	 * The maximum nember of hours since the last database insert to initiate an alert email.
	 *
	 */
	protected $maxHours = 12;

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
    	$itemInserted = true;
    	$maxTime = date("Y-m-d H:i:s", strtotime('-' . $this->maxHours .  ' hours'));
    	foreach(self::$eventModels as $event)
	    {
		    $lastInserted = $event::where('created_at', '>', $maxTime)->get()->toArray();
		    if(!$lastInserted) {
			    $itemInserted = false;
		    }
	    }

        if (!$itemInserted) {
    		$msg = 'The Sendgrid data API generated an error : nothing has been inserted into the database for ' . $this->maxHours . ' hours.';
	        EventController::sendAlertEmail($msg);
        }
    }
}
