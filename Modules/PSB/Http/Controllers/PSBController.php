<?php

namespace Modules\PSB\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

class PSBController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('psb::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('psb::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {   
        // dd($request->all());
        $gambar = $request->file('foto');
        $nm_file = $gambar->getClientOriginalName();
        $token = session()->get('token');
        $client = new Client();
        $headers = ['Authorization' => $token];
        $send = $client->request(
            'POST',
            env('API_URL') . '/siswabaru',
            [
                'headers' => [
                    'Authorization' => $headers
                ],
                'multipart' => [
                    [
                        'name' => 'nama_siswa',
                        'contents' => $request->nama_siswa
                    ],
                    [
                        'name' => 'jenis_kelamin',
                        'contents' => $request->jenis_kelamin
                    ],
                    [
                        'name' => 'nisn',
                        'contents' => $request->nisn
                    ],
                    [
                        'name' => 'nik',
                        'contents' => $request->nik
                    ],
                    [
                        'name' => 'tempat_tgl_lahir',
                        'contents' => $request->tempat_tgl_lahir
                    ],
                    [
                        'name' => 'agama',
                        'contents' => $request->agama
                    ],
                    [
                        'name' => 'status_keluarga',
                        'contents' => $request->status_keluarga
                    ],
                    [
                        'name' => 'anak_ke',
                        'contents' => $request->anak_ke
                    ],
                    [
                        'name' => 'jml_saudara_kandung',
                        'contents' => $request->jml_saudara_kandung
                    ],
                    [
                        'name' => 'sekolah_asal',
                        'contents' => $request->sekolah_asal
                    ],
                    [
                        'name' => 'nama_ayah',
                        'contents' => $request->nama_ayah
                    ],
                    [
                        'name' => 'ttl_ayah',
                        'contents' => $request->ttl_ayah
                    ],
                    [
                        'name' => 'pekerjaan_ayah',
                        'contents' => $request->pekerjaan_ayah
                    ],
                    [
                        'name' => 'pendidikan_ayah',
                        'contents' => $request->pendidikan_ayah
                    ],
                    [
                        'name' => 'penghasilan_ayah',
                        'contents' => $request->penghasilan_ayah
                    ],
                    [
                        'name' => 'nama_ibu',
                        'contents' => $request->nama_ibu
                    ],
                    [
                        'name' => 'ttl_ibu',
                        'contents' => $request->ttl_ibu
                    ],
                    [
                        'name' => 'pekerjaan_ibu',
                        'contents' => $request->pekerjaan_ibu
                    ],
                    [
                        'name' => 'pendidikan_ibu',
                        'contents' => $request->pendidikan_ibu
                    ],
                    [
                        'name' => 'penghasilan_ibu',
                        'contents' => $request->penghasilan_ibu
                    ],
                    [
                        'name' => 'nama_wali',
                        'contents' => $request->nama_wali
                    ],
                    [
                        'name' => 'ttl_wali',
                        'contents' => $request->ttl_wali
                    ],
                    [
                        'name' => 'pekerjaan_wali',
                        'contents' => $request->pekerjaan_wali
                    ],
                    [
                        'name' => 'pendidikan_wali',
                        'contents' => $request->pendidikan_wali
                    ],
                    [
                        'name' => 'penghasilan_wali',
                        'contents' => $request->penghasilan_wali
                    ],
                    [
                        'name' => 'jenis_tinggal',
                        'contents' => $request->jenis_tinggal
                    ],
                    [
                        'name' => 'alamat',
                        'contents' => $request->alamat
                    ],
                    [
                        'name' => 'rt_rw',
                        'contents' => $request->rt_rw
                    ],
                    [
                        'name' => 'kelurahan',
                        'contents' => $request->kelurahan
                    ],
                    [
                        'name' => 'kode_pos',
                        'contents' => $request->kode_pos
                    ],
                    [
                        'name' => 'kecamatan',
                        'contents' => $request->kecamatan
                    ],
                    [
                        'name' => 'kabupaten',
                        'contents' => $request->kabupaten
                    ],
                    [
                        'name' => 'provinsi',
                        'contents' => $request->provinsi
                    ],
                    [
                        'name' => 'tinggi_badan',
                        'contents' => $request->tinggi_badan
                    ],
                    [
                        'name' => 'berat_badan',
                        'contents' => $request->berat_badan
                    ],
                    [
                        'name' => 'nomor_tlp',
                        'contents' => $request->nomor_tlp
                    ],
                    [
                        'name' => 'jarak',
                        'contents' => $request->jarak
                    ],
                    [
                        'name' => 'alat_transportasi',
                        'contents' => $request->alat_transportasi
                    ],
                    [
                        'name' => 'email',
                        'contents' => $request->email
                    ],
                    [
                        'name' => 'foto',
                        'contents' => $nm_file
                    ],
                    [
                        'name' => 'foto',
                        'contents' => fopen($gambar, 'r'),
                        'filename' => $nm_file
                    ],
                ]
            ]
        );

        if ($send) {
            return redirect('psb')->with(['response' => 'success', 'message' => 'Data Siswa Berhasil Ditambah']);
        } else {
            return redirect('psb')->with(['response' => 'error', 'message' => 'Data Siswa Gagal Ditambah']);
        }  
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('psb::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('psb::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
