<?php

namespace App\Mail;

use App\School;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InviteSchool extends Mailable
{
    use Queueable, SerializesModels;

    public $school;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(School $school){
        $this->school = $school;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->subject('Your School has been invited.')
                    ->view('emails.invite_school');
    }
}
