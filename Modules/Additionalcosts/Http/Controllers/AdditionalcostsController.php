<?php

namespace Modules\Additionalcosts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

class AdditionalcostsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
     $client = new Client();
     $token = session('token');
     $id_sekolah = session()->get('sekolah')['id_sekolah'];
     $res = $client->get(env('API_URL').'/biaya-lainnya/?id_sekolah='.$id_sekolah,[
      'headers' => [
        'Authorization'     => $token
      ]
    ]);

     $dataAdditionalCosts = json_decode($res->getBody()->getContents());

     return view('additionalcosts::index',compact('dataAdditionalCosts'));
   }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
      $Client = new Client();
      $Token = session()->get('token');
      $data_student = $Client->request('GET',env('API_URL').'/siswa/',[
        'headers' => [ 'Authorization' => $Token ],]);
      $student = json_decode($data_student->getBody()->getContents());
      return view('additionalcosts::create',compact('student'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
      $validate = $request->validate([
        'nama_biaya' => 'required',
        'detail' => 'required',
        'total_pembayaran' => 'required',
        'id_siswa' => 'required',
      ]);

      $client = new Client();
      $token = session('token');
      $res = $client->post(env('API_URL').'/biaya-lainnya',[
        'headers' => [
          'Authorization'     => $token
        ],
        'multipart' => [
         [
          'name' => 'nama_biaya',
          'contents' => $request->nama_biaya
        ],
        [
          'name' => 'detail',
          'contents' => $request->detail
        ],
        [
          'name' => 'total_pembayaran',
          'contents' => $request->total_pembayaran
        ],
        [
          'name' => 'status',
          'contents' => 'belum'
        ],
        [
          'name' => 'id_sekolah',
          'contents' => session()->get('sekolah')['id_sekolah']
        ],
        [
          'name' => 'id_siswa',
          'contents' => $request->id_siswa
        ]
      ]
    ]);
      return redirect()->route('Additionalcosts.index')->with(['response' => 'success', 'message' => 'Data Biaya Lain Berhasil Ditambah']);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
      return view('additionalcosts::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
      $Client = new Client();
      $Token = session()->get('token');
      $idschool = session()->get('sekolah')['id_sekolah'];
      $data_additionalcosts = $Client->request('GET',env('API_URL').'/biaya-lainnya/'.$id,[
        'headers' => [ 'Authorization' => $Token ],]);
      $data_student = $Client->request('GET',env('API_URL').'/siswa/',[
        'headers' => [ 'Authorization' => $Token ],]);
      $additionalcost = json_decode($data_additionalcosts->getBody()->getContents());
      $student = json_decode($data_student->getBody()->getContents());
      $data = array(
        'edit_Additionalcost' => $additionalcost,
        'select_siswa'        => $student,
      );
      return view('additionalcosts::edit',$data);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
      $Token = session()->get('token');
      $idschool = session()->get('sekolah')['id_sekolah'];
      $Client = new Client();
      if ($request->bukti_pembayaran == null) {
        $update = $Client->request('PATCH',env('API_URL').'/biaya-lainnya/'.$request->id_tr_biayalain,[
          'headers' => [ 'Authorization' => $Token ],
          'multipart' => [
            [
              'name'        => 'nama_biaya',
              'contents'     => $request->nama_biaya,
            ],[
              'name'        => 'detail',
              'contents'     => $request->detail,
            ],[
              'name'        => 'total_pembayaran',
              'contents'     => $request->total_pembayaran,
            ],[
              'name'        => 'id_siswa',
              'contents'     => $request->id_siswa,
            ],[
             'name'        => 'id_sekolah',
             'contents'     => $idschool,
           ],
         ],
       ]);
        return redirect()->route('Additionalcosts.index');
      }else {
        $update = $Client->request('PATCH',env('API_URL').'/biaya-lainnya/'.$request->id_tr_biayalain,[
          'headers' => [ 'Authorization' => $Token ],
          'multipart' => [
            [
              'name'        => 'nama_biaya',
              'contents'     => $request->nama_biaya,
            ],[
              'name'        => 'detail',
              'contents'     => $request->detail,
            ],[
              'name'        => 'total_pembayaran',
              'contents'     => $request->total_pembayaran,
            ],[
              'name'        => 'id_siswa',
              'contents'     => $request->id_siswa,
            ],[
             'name'        => 'id_sekolah',
             'contents'     => $idschool,
           ],[
            'name'        => 'bukti_pembayaran',
            'contents'     => 'bukti_transaksi/'.$name_file,
          ],
          [
            'name'        => 'bukti_transaksi',
            'contents'     => fopen($gambar, 'r'),
            'filename'    => $name_file,
          ],
        ],
      ]);
      }
      return redirect()->route('Additionalcosts.index');
    }
    public function Acc(Request $request)
    {
      $Token = session()->get('token');
      $idschool = session()->get('sekolah')['id_sekolah'];
      $Client = new Client();
      $Acc = $Client->request('PATCH',env('API_URL').'/biaya-lainnya/'.$request->id_tr_biayalain,[
        'headers' => [ 'Authorization' => $Token, ],
        'form_params' => [
          'status' =>$request->Status,
        ],
      ]);
      return redirect()->route('Additionalcosts.index');
    }
    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
      $get_token = session()->get('token');
      $client = new Client();
      $client->request('DELETE', env('API_URL') . '/biaya-lainnya/' . $id, [
          'headers' => [
              'Authorization' => $get_token
          ]
      ]);
      return redirect()->route('Additionalcosts.index');
    }
  }
