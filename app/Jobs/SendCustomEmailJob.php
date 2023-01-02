<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendCustomEmail;

class SendCustomEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;
    protected $bcc;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details, $bcc=[])
    {
        $this->details = $details;
        $this->bcc = $bcc;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Artisan::call('optimize:clear');
        Mail::to(env('MAIL_FROM_ADDRESS'))->bcc($this->bcc)->send(new SendCustomEmail($this->details));
    }
}
