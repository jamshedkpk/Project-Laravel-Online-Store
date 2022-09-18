<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;
    public $detail;

    public function __construct($detail)
    {
        $this->detail=$detail;
    }

    public function build()
    {
        return $this->subject("This email is from jamshed secretary")->view('mail');
    }
}
