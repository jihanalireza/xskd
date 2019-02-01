<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name)
    {
       $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      $date = date('Y-m-d H:i:s');
      $addminutes = date('Y-m-d H:i:s',strtotime('+3 minutes',strtotime($date)));
      $data = array(
        'expired' => $addminutes
      );
        return $this->markdown('forgotpassword::sendmail',$data)->subject('Reset Password')
                    ->from('sistemakademik@gmail.com','Sistem Akademik');;
    }
}
