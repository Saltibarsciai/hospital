<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PrescriptionMail extends Mailable
{
    use Queueable, SerializesModels;

    private $drugs;
    private $instructions;
    private $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $instructions, $drugs)
    {
        $this->name = $name;
        $this->instructions = $instructions;
        $this->drugs = $drugs;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): PrescriptionMail
    {
        return $this->view('emails.prescription', [
            'name' => $this->name,
            'instructions' => $this->instructions,
            'drugs' => $this->drugs
        ]);
    }
}
