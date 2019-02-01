<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendInvoice extends Mailable
{
    use Queueable, SerializesModels;
    public $name ;
    public $dataUser ;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $dataUser)
    {
        $this->name = $name;
        $this->dataUser = $dataUser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //dd($this->dataUser);
        $date = date('Y-m-d H:i:s');
        $addminutes = date('Y-m-d H:i:s', strtotime('+3 minutes', strtotime($date)));
        $data = array(
            'expired' => $addminutes,
                'data' => $this->dataUser
        );
        return $this->markdown('borrowbook::invoice', $data)->subject('Peringatan Pengembalian Buku')
            ->from('Intratraining@gmail.com', 'Intra Training');;
    }

}
