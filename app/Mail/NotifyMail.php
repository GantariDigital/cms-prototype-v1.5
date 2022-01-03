<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class NotifyMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->details->pathToImage = env('SECTOR_PUBLIC_PATH') . '/' . Storage::disk('sector_disk')->path($this->details->path.$this->details->file_name);
        return $this->subject('New Report: '.$this->details->image_name)
        ->view('layouts.mail.notification-mail')
        ->with(['data' => $this->details]);
    }
}
