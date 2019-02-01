<?php

namespace Modules\Bookdata\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
class BookdataController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $token     = session()->get('token');
        $client    = new Client();
        $idsekolah = session()->get('sekolah')['id_sekolah'];
        $get_book = $client->request('GET',env('API_URL').'/buku?id_sekolah='.$idsekolah, [
              'headers' => ['Authorization' => $token ]
            ]);
        $book_data = json_decode($get_book->getBody()->getContents());

        return view('bookdata::index',compact('book_data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
      $token     = session()->get('token');
      $client    = new Client();
      $get_data_kelas = $client->request('GET',env('API_URL').'/kelas', [
            'headers' => ['Authorization'     => $token ]
         ]);
      $kelas = json_decode($get_data_kelas->getBody()->getContents());

      return view('bookdata::create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
      $validateStore = $request->validate([
        'tahun_terbit' => 'required',
      ]);
      $client = new Client();
      $token = session('token');
      // dd($token);
      $res = $client->post(env('API_URL').'/buku',[
        'headers' => [
            'Authorization'     => $token
        ],
          'form_params' => [
            'kd_buku' => $request->kd_buku,
            'nama_buku' => $request->nama_buku,
            'penerbit' => $request->penerbit,
            'stock' => $request->stock,
            'penulis' => $request->penulis,
            'stock' => $request->stock,
            'tahun_terbit' => $request->tahun_terbit,
            'id_sekolah' => session()->get('sekolah')['id_sekolah'],
            'id_kelas' => $request->id_kelas,
         ]
      ]);
      return redirect('bookdata');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('bookdata::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
      $token = session()->get('token');
      $client = new Client();
      // get data kelas based on id_sekolah
      $get_data_kelas=$client->request('GET',env('API_URL').'/kelas?id_sekolah='.session()->get('sekolah')['id_sekolah'], [
      'headers' => [
      'Authorization' => $token
      ]
      ]);
      // get data buku
      $get_data_buku=$client->request('GET',env('API_URL').'/buku/'.$id, [
      'headers' => [
      'Authorization' => $token
      ]
      ]);
      $databuku = json_decode($get_data_buku->getBody()->getContents());
      $datakelas = json_decode($get_data_kelas->getBody()->getContents());
      return view('bookdata::edit',['databuku' => $databuku, 'datakelas' => $datakelas]);
}

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
      $token = session()->get('token');
      $client = new Client();
      $headers = ['Authorization' => $token];
      $send = $client->request('PATCH',env('API_URL').'/buku/'.$request->id_buku,
      [
      'headers' => [
      'Authorization' => $headers
      ],
      'form_params' => [
        'kd_buku' => $request->kd_buku,
        'nama_buku' => $request->nama_buku,
        'penerbit' => $request->penerbit,
        'penulis' => $request->penulis,
        'tahun_terbit' => $request->tahun_terbit,
        'id_sekolah' => session()->get('sekolah')['id_sekolah'],
        'id_kelas' => $request->id_kelas,
      ]
      ]);

      return redirect()->route('indexBookdata');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $get_token = session()->get('token');
        $client = new Client();
        $client->request('DELETE', env('API_URL') . '/buku/' . $id, [
            'headers' => [
                'Authorization' => $get_token
            ]
        ]);
        return redirect()->route('indexBookdata');
    }

    public function getclass()
{
    $token     = session()->get('token');
    $idsekolah     = session()->get('sekolah')['id_sekolah'];
    $client    = new Client();
    $get_data_class = $client->request('GET',env('API_URL').'/kelas', [
       'headers' => ['Authorization'     => $token ]
   ]);
    $class = json_decode($get_data_class->getBody()->getContents());
    return collect($class)->whereIn('id_sekolah',$idsekolah);
}
}
