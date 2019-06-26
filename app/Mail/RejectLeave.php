<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use Auth;
use Carbon\Carbon;

class RejectLeave extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_data)
    {
        $this->user_data = $user_data['user'];
        $this->url = $user_data['url'];
        $this->date = Carbon::now();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(User::find(Auth::id())->first()->email)->subject('Leave Rejection')->markdown('emails.leaves.reject')->with('user_data', $this->user_data)->with('date', $this->date)
            ->with('url', $this->url);
    }
}
