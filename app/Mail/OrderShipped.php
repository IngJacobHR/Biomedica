<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Sense;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;
    public $sense;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Sense $sense)
    {
        $this->sense = $sense;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Novedad')->view('Mails.test')
                    ->with([
                        'name' => $this->sense->name,
                        'type' => $this->sense->type,
                        'val' => $this->sense->val,
                        'updated_at' => $this->sense->updated_at,
                        'location' => $this->sense->location

                    ]);
    }
}
