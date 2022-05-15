<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Reply;

class ReplyTicket extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $reply;
    protected $result;

    public function __construct($reply, $result)
    {
        $this->reply = $reply;
        $this->result = $result;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.reply')
                    ->to($this->reply->email)
                    ->from('hello@example.com', 'Online Support Platform')
                    ->with([
                        'customer_name' => $this->reply->customer_name,
                        'reference_no' => $this->reply->reference_no,
                        'reply' => $this->result->reply,
                    ]);
    }
}
