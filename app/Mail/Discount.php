<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Discount extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        /* return $this->subject('End of Summer Sale 🏖️')->markdown('email.discount_email_Kuwait'); */

        /* return $this->subject('End of Summer Sale 🏖️')->markdown('email.discount_email_Egypt'); */

        /* return $this->subject('End of Summer Sale 🏖️')->markdown('email.discount_email'); */


        return $this->subject('مسابقة سحب على ألبوم ڤي 🎁')->markdown('email.sale_email');

        /* return $this->subject('End of summer sale')->markdown('email.complain_Mail')->with('data', $this->data); */

    }
}
