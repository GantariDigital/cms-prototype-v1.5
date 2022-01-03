<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\NotifyMail;
use Mail;
use App\Models\User;

class SendEmailNotifJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $details = $this->details;
        $users = User::whereHas(
            'roles', function ($query) use($details)
            {
                $query->where(function ($query) use($details)
                {
                    $query->where(['name' => "Divisi {$details->divisi} [VIEW ONLY]", 'guard_name' => 'web']);
                })->orWhere(function ($query) use($details)
                {
                    $query->where(['name' => "Menu {$details->menu} [VIEW ONLY]", 'guard_name' => 'web']);
                })->orWhere(function ($query)
                {
                    $query->where(['name' => "Menu All [VIEW ONLY]", 'guard_name' => 'web']);
                });
            }
        )->get();

        if($users) {
            $email = new NotifyMail($this->details);
            Mail::bcc($users)
            ->send($email);
        }
    }
}
