<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class profile extends Controller
{
    public function index(){
        if(session()->get('role')['id_role'] == 5){
            $token     = session()->get('token');
            $idschool = session()->get('sekolah')['id_sekolah'];
            $idguru = session()->get('sekolah')['id_guru'];
            $client    = new Client();
            $get_data_class = $client->request('GET',env('API_URL').'/riwayatpelatihan', [
            'headers' => ['Authorization'     => $token ]
            ]);
            $get_data_pendidikan = $client->request('GET',env('API_URL').'/riwayatpendidikan', [
                'headers' => ['Authorization'     => $token ]
            ]);
            $resultpendidikan = json_decode($get_data_pendidikan->getBody()->getContents());
            $datapendidikan = collect($resultpendidikan)->whereIn('id_sekolah',$idschool)->whereIn('id_guru',$idguru);
            $result = json_decode($get_data_class->getBody()->getContents());
            $dataclass = collect($result)->whereIn('id_sekolah',$idschool)->whereIn('id_guru',$idguru);

            $data = array(
                'pelatihan' => $dataclass,
                'pendidikan' => $datapendidikan
            );
            return view('index',$data);
        }else{
            return view('index');
        }
    }
    public function simpansertifikasi(Request $request){
        $name = $request->namapelatihan;
        $jenispelatihan = $request->jenispelatihan;
        $gambar = $request->file('fotosertifikasi');

        $tanggalpelatihan = $request->tanggalpelatihan;
        $token = session('token');
        foreach( $name as $key => $n ) {
            
            $client = new Client();
            $res = $client->request('POST', env('API_URL').'/riwayatpelatihan', [
                'headers' => [
                    'Authorization'     => $token
                ],
                'multipart' => [
                    [
                        'name' => 'nama_pelatihan',
                        'contents' => $n
                    ],
                    [
                        'name' => 'jenis_pelatihan',
                        'contents' => $jenispelatihan[$key]
                    ],
                    [
                        'name' => 'tanggal_pelatihan',
                        'contents' =>$tanggalpelatihan[$key]
                    ],
                    [
                        'name' => 'foto_sertifikasi',
                        'contents'=> 'sertifikasi/'.$gambar[$key]->getClientOriginalName(),
                    ],
                    [
                        'name' => 'foto_sertifikasi',
                        'contents'=>fopen($gambar[$key], 'r'),
                        'filename'  => $gambar[$key]->getClientOriginalName()
                    ],
                    [
                        'name' => 'id_sekolah',
                        'contents' => session()->get('sekolah')['id_sekolah'],
                    ],
                    [
                        'name' => 'id_guru',
                        'contents' => session()->get('sekolah')['id_guru'],
                    ]
                ]
            ]);
        }
        return redirect('/')->with(['response' => 'success', 'message' => 'Data Pelatihan Berhasil di tambah']);
    }
    public function simpanpendidikan(Request $request){
        $name = $request->namasekolah;
        $jenjang = $request->jenjangpendidikan;
        $tanggalmasuk = $request->tanggalmasuk;

        $tanggalselesai = $request->tanggalselesai;
        $token = session('token');
        foreach( $name as $key => $n ) {
            
            $client = new Client();
            $res = $client->request('POST', env('API_URL').'/riwayatpendidikan', [
                'headers' => [
                    'Authorization'     => $token
                ],
                'form_params' => [
                    'nama_sekolah' => $n,
                    'jenjang' => $jenjang[$key],
                    'tanggal_masuk'=>$tanggalmasuk[$key],
                    'tanggal_selesai'=>$tanggalselesai[$key],
                    'id_guru' => session()->get('sekolah')['id_guru'],
                    'id_sekolah' => session()->get('sekolah')['id_sekolah']
                ]
            ]);
        }
        return redirect('/')->with(['response' => 'success', 'message' => 'Data Riwayat Pendidikan Berhasil di tambah']);
    }
}
