<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class InvoiceSpp extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($getSpp)
    {
        $this->getSpp = $getSpp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $dataSpp = $this->getSpp;

        $client     = new Client();
        $getUser    = $client->request('GET',env('API_URL').'/users?id_siswa='.$dataSpp->id_siswa);
        $dataUser   = json_decode($getUser->getBody()->getContents());
        $dataUser   = collect($dataUser)->first();

        $getOpsiSpp     = $client->request('GET',env('API_URL').'/transaksi-spp?status=telat&status=belumbayar');
        $dataOpsiSpp    = json_decode($getOpsiSpp->getBody()->getContents());
        $dataOpsiSpp    = collect($dataOpsiSpp);

        $data = array(
            'dataSpp' => $dataSpp,
            'dataOpsiSpp' => $dataOpsiSpp,
        );



        return $this->markdown('emails.invoice.invoicespp',$data)
        ->to($dataUser->email)
        ->subject('Invoice Spp')
        ->from(env('MAIL_USERNAME'),env('APP_NAME'));
    }
}
