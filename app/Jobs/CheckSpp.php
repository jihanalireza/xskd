<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Mail;
use App\Mail\InvoiceSpp;


class CheckSpp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
     $client    = new Client();
     $getSpp    = $client->request('GET',env('API_URL').'/pembayaran-spp?parameter='.date('d',strtotime("-1 days")));
     $data      = json_decode($getSpp->getBody()->getContents());
     $dataSpp   =  collect($data);

     foreach ($dataSpp as $itemSpp)
     {
              $addmonth = date('Y-m-'.$itemSpp->parameter,strtotime("+1 month"));

              $patch_transaksi_spp = $client->request('PATCH',env('API_URL').'/transaksi-spp?id_tr_spp='.$itemSpp->id_tr_spp.'&status=belumbayar',[
                    'form_params' => [
                      'status'    => 'telat'
                  ]
              ]);
                
              $post_transaksi_spp = $client->request('POST',env('API_URL').'/transaksi-spp/',[
                    'form_params' => [
                      'total_dibayarkan'    => $itemSpp->biaya_bulanan,
                      'batas_akhir'         => $addmonth,
                      'status'              => 'belumbayar',  
                      'no_invoice'          => rand().date('his'),
                      'id_tr_spp'           => $itemSpp->id_tr_spp,
                      'id_siswa'            => $itemSpp->id_siswa,
                      'id_sekolah'          => $itemSpp->id_sekolah,
                  ]
              ]);

              $update_tr_spp = $client->request('PATCH',env('API_URL').'/pembayaran-spp/'.$itemSpp->id_tr_spp,[
                    'form_params' => [
                        'keterlambatan'     => $addmonth,
                        'total_pembayaran'  => $itemSpp->biaya_bulanan,
                        'status'            => 'belumbayar'  
                    ]
              ]);


              Mail::send(new InvoiceSpp($itemSpp));
    }
}
}
