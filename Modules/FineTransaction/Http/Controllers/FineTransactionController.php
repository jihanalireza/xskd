<?php

namespace Modules\FineTransaction\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

class FineTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $token     = session()->get('token');
        $client    = new Client();
        $get_fine = $client->request('GET',env('API_URL').'/denda-buku', [
              'headers' => ['Authorization' => $token ]
            ]);
        $fine_data = json_decode($get_fine->getBody()->getContents());
        
        return view('finetransaction::index',compact('fine_data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
      $datastudent = $this->getsiswa();
      // dd($datastudent);
      $data = array(
        'datastudent' => $datastudent
      );

      return view('finetransaction::create',$data );
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
      $validateStore = $request->validate([
        'id_siswa' => 'required',
        'denda' => 'required',
        'keterlambatan' => 'required',
      ]);
      $idschool  = session()->get('sekolah')['id_sekolah'];
      $token = session()->get('token');
      $client = new Client();
      $send = $client->request('POST',env('API_URL').'/denda-buku/',
      [
        'headers' => ['Authorization' => $token ],
          'multipart' => [
          [
            'name' => 'id_siswa',
            'contents' => $request->id_siswa,
          ],
          [
            'name' => 'id_sekolah',
            'contents' => $idschool,
          ],
          [
            'name' => 'denda',
            'contents' => $request->denda,
          ],
          [
            'name' => 'keterlambatan',
            'contents' => $request->keterlambatan,
          ],
          [
            'name' => 'total_bayar',
            'contents' => $request->denda * $request->keterlambatan,
          ],
        ]
      ]);
      if ($send) {
            return redirect('finetransaction')->with(['response' => 'success', 'message' => 'Data FineTransaction Berhasil Ditambah']);
        } else {
            return redirect('finetransaction')->with(['response' => 'error', 'message' => 'Data FineTransaction Gagal Ditambah']);
        }
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('finetransaction::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
      $token     = session()->get('token');
      $idschool  = session()->get('sekolah')['id_sekolah'];
      $client    = new Client();
      $get_fine = $client->request('GET',env('API_URL').'/denda-buku/'.$id, [
            'headers' => ['Authorization' => $token ]
          ]);
      $get_student = $client->request('GET',env('API_URL').'/siswa',[
        'headers' => ['Authorization' => $token ]
      ]);
      $fine_data = json_decode($get_fine->getBody()->getContents());
      $student_data = json_decode($get_student->getBody()->getContents());
      $data = array(
        'fine_data' => $fine_data,
        'select_student' => $student_data,
       );
        return view('finetransaction::edit',$data);
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
      if ($request->keterlambatan == 0) {
        $update = $Client->request('PATCH',env('API_URL').'/denda-buku/'.$request->id_denda,[
          'headers' => [ 'Authorization' => $Token ],
          'multipart' => [
            [
              'name'        => 'denda',
              'contents'     => $request->Denda,
            ]
            ,[
              'name'        => 'keterlambatan',
              'contents'     => $request->keterlambatan,
            ],[
              'name'        => 'total_bayar',
              'contents'     => $request->Denda * 1,
            ],[
              'name'        => 'id_siswa',
              'contents'     => $request->id_siswa,
            ],[
               'name'        => 'id_sekolah',
               'contents'     => $idschool,
            ],
          ],]);
          if ($update) {
            return redirect()->route('FineTransaction.index')->with(['response' => 'success', 'message' => 'Data Transaksi Denda Berhasil Di Update']);
          }else {
            return redirect()->route('FineTransaction.index')->with(['response' => 'error', 'message' => 'Data Transaksi Denda Gagal Di Update']);
          }
      } else {
      $update = $Client->request('PATCH',env('API_URL').'/denda-buku/'.$request->id_denda,[
        'headers' => [ 'Authorization' => $Token ],
        'multipart' => [
          [
            'name'        => 'denda',
            'contents'     => $request->Denda,
          ]
          ,[
            'name'        => 'keterlambatan',
            'contents'     => $request->keterlambatan,
          ],[
            'name'        => 'total_bayar',
            'contents'     => $request->Denda * ($request->keterlambatan + 1),
          ],[
            'name'        => 'id_siswa',
           'contents'     => $request->id_siswa,
           ],[
             'name'        => 'id_sekolah',
             'contents'     => $idschool,
           ],
        ],]);
        if ($update) {
          return redirect()->route('FineTransaction.index')->with(['response' => 'success', 'message' => 'Data Transaksi Denda Berhasil Di Update']);
        }else {
          return redirect()->route('FineTransaction.index')->with(['response' => 'error', 'message' => 'Data Transaksi Denda Gagal Di Update']);
        }
      }
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
      $get_token = session()->get('token');
      $client = new Client();
      $client->request('DELETE', env('API_URL') . '/denda-buku/' . $id, [
          'headers' => [
              'Authorization' => $get_token
          ]
      ]);
      if($client){
          return redirect('finetransaction')->with(['response'=> 'success', 'message' => 'Data Transaksi Denda Berhasil Dihapus']);
      }else{
          return redirect('finetransaction')->with(['response' => 'error', 'message' => 'Data Transaksi Denda Gagal Dihapus']);
      }

    }

    public function getsiswa()
    {
        $token     = session()->get('token');
        $idsekolah     = session()->get('sekolah')['id_sekolah'];
        $client    = new Client();
        $get_data_siswa = $client->request('GET',env('API_URL').'/siswa', [
           'headers' => ['Authorization'     => $token ]
       ]);
        $siswa = json_decode($get_data_siswa->getBody()->getContents());
        return collect($siswa)->whereIn('id_sekolah',$idsekolah);
    }
}
