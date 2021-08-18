<?php

namespace App\Jobs;

use App\Events\CustomerIdentified;
use App\Models\Wallet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessWebhook implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $event;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $event)
    {
        $this->event = $event;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $event = $this->event['event'];
        $data = $this->event['data'];
        if($event == 'customeridentification.success'):
            Wallet::where('customerCode', $data['customer_code'])->update(['verified', 1]);
            CustomerIdentified::dispatch($data['customer_code']);
        elseif($event == 'charge.success'):
            Wallet::where('customerCode', $data['customer_code'])->update(['accountBalance', $data['amount']/100]);
        endif;
    }
}
