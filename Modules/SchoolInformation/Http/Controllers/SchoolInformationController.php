<?php

namespace Modules\SchoolInformation\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class SchoolInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $token     = session()->get('token');
        $idsekolah = session()->get('sekolah')['id_sekolah'];
        $client    = new Client();
        $get_data_informasi = $client->request('GET',env('API_URL').'/informasisekolah', [
          'headers' => ['Authorization'  => $token ]
        ]);
        $schoolinformation = json_decode($get_data_informasi->getBody()->getContents());
        $datainformasi = collect($schoolinformation)->whereIn('id_sekolah',$idsekolah);

        $data = array(
            'datainformasi' => $datainformasi
        );

        return view('schoolinformation::index',$data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('schoolinformation::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
      $client = new Client();
      $token = session('token');
      $res = $client->post(env('API_URL').'/informasisekolah',[
        'headers' => [
            'Authorization'     => $token
        ],
          'form_params' => [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'id_sekolah' => session()->get('sekolah')['id_sekolah'],
         ]
      ]);
      return redirect('/schoolinformation');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('schoolinformation::show');

    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $token = session()->get('token');
        $client = new Client();
        $get_informasisekolah = $client->request('GET', env('API_URL') . '/informasisekolah/' . $id, [
            'headers' => [
                'Authorization' => $token,
            ],
        ]);
        $informasisekolah = json_decode($get_informasisekolah->getBody()->getContents());
        return view('schoolinformation::edit', compact('informasisekolah'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request,$id)
    {
        $token = session()->get('token');
        $client = new Client();
        $update = $client->request('PATCH', env('API_URL') . '/informasisekolah/' . $request->id_kelas, [
            'headers' => [
                'Authorization' => $token,
            ],
            'form_params' => [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
            ],
        ])->getBody();

        if ($update) {
            return redirect()->route('SchoolInformation.index')->with(['response' => 'success', 'message' => 'Data Informasi Sekolah Berhasil Diubah']);
        } else {
            return redirect()->route('SchoolInformation.index')->with(['response' => 'error', 'message' => 'Data Informasi Sekolah Gagal Diubah']);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id_informasi)
    {
        $get_token = session()->get('token');
        $client = new Client();
        $client->request('DELETE', env('API_URL') . '/informasisekolah/' . $id_informasi, [
            'headers' => [
                'Authorization' => $get_token
            ]
        ]);

        if ($client) {
            return redirect()->route('SchoolInformation.index')->with(['response' => 'success', 'message' => 'Data Informasi Sekolah Berhasil Dihapus']);
        } else {
            return redirect()->route('SchoolInformation.index')->with(['response' => 'error', 'message' => 'Data Informasi Sekolah Gagal Dihapus']);
        }
    }
}
