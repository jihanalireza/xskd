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

class CheckBorrowing implements ShouldQueue
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
      $getBorrow = $client->request('GET',env('API_URL').'/peminjam-buku?status=dipinjam&tgl_pengembalian='.date('m/d/Y',strtotime("-1 days")));
      $data = json_decode($getBorrow->getBody()->getContents());
      $borrowData =  collect($data);
      
      foreach ($borrowData as $itemBorrow) {
        $getBorrow = $client->request('PATCH',env('API_URL').'/peminjam-buku/'.$itemBorrow->id_pinjam_buku,[
            'form_params' => [
                'status'  => 'telat',
            ]
        ]);
      }


    }
}
