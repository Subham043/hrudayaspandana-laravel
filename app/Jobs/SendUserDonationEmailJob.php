<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendUserDonationEmail;
use Storage;
use File;

class SendUserDonationEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;
    protected $file;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details, $file)
    {
        $this->details = $details;
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new SendUserDonationEmail($this->details, $this->file));
        if(File::exists('/public/certificate/'.$this->file)){
            Storage::delete('/public/certificate/'.$this->file);
        }
    }
}
