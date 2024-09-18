<?php

namespace app\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DemoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private string $name;

    private string $bladeName;

    public function __construct(string $name, string $bladeName)
    {
        $this->name = $name;
        $this->bladeName = $bladeName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): DemoMail
    {
        return $this->view('emails.' . $this->bladeName)
            ->with([
                'name' => $this->name
            ]);
    }
}
