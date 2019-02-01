<?php

namespace Modules\SPP\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use GuzzleHttp\Client;
use Illuminate\Routing\Controller;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

class SPPController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
      $token     = session()->get('token');
      $client    = new Client();
      $get_tr_spp = $client->request('GET',env('API_URL').'/pembayaran-spp', [
        'headers' => ['Authorization' => $token ]
      ]);
      $data_tr_spp = json_decode($get_tr_spp->getBody()->getContents());

      return view('spp::index',compact('data_tr_spp'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
      $datastudent = $this->getstudent();

      $data = array(
        'datastudent' => $datastudent
      );
      return view('spp::create',$data);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
      $token = session()->get('token');
      $idschool = session()->get('sekolah')['id_sekolah'];
      $client = new Client();
      $token = session('token');
      $res = $client->post(env('API_URL').'/pembayaran-spp',[
        'headers' => [
            'Authorization'     => $token
        ],
        'multipart' => [
            [
                'name' => 'id_siswa',
                'contents' => $request->siswa
            ],
            [
                'name' => 'parameter',
                'contents' => $request->parameter
            ],
            [
                'name' => 'biaya_bulanan',
                'contents' => $request->biaya_bulanan
            ],
            [
                'name' => 'keterlambatan',
                'contents' => $request->keterlambatan." Bulan"
            ],
            [
                'name' => 'status',
                'contents' => $request->status
            ],
            [
                'name' => 'total_pembayaran',
                'contents' => $request->total_pembayaran
            ],
            [
                'name' => 'id_sekolah',
                'contents' => $idschool
            ],
        ]
    ]);
      return redirect('spp');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('spp::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $token = session()->get('token');
        $idschool = session()->get('sekolah')['id_sekolah'];
        $CLient = new CLient();
        $get_data_spp = $CLient->request('GET',env('API_URL').'/pembayaran-spp/'.$id,[
            'headers' => ['Authorization' => $token ]
        ]);
        $get_data_student = $CLient->request('GET',env('API_URL').'/siswa',[
            'headers' => ['Authorization' => $token ]
        ]);
        $tr_spp = json_decode($get_data_spp->getBody()->getContents());
        $student = json_decode($get_data_student->getBody()->getContents());
        $data = array('tr_Spp' => $tr_spp, 'select_student' => $student );
        return view('spp::edit',$data);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
      // dd();
      $CLient = new Client();
      $token = session()->get('token');
      $idschool = session()->get('sekolah')['id_sekolah'];
      if ($request->keterlambatan == 0) {
        $Update = $CLient->request('PATCH',env('API_URL').'/pembayaran-spp/'.$request->id_tr_spp,[
          'headers' => [ 'Authorization' => $token ],
          'multipart' =>[
            [
              'name' => 'parameter',
              'contents' => $request->parameter,
            ],[
              'name'  => 'biaya_bulanan',
              'contents' => $request->biaya_bulanan,
            ],[
              'name' => 'keterlambatan',
              'contents' => $request->keterlambatan,
            ],[
              'name' => 'total_pembayaran',
              'contents' => $request->biaya_bulanan * 1,
            ],[
              'name'  => 'id_siswa',
              'contents'  => $request->id_siswa,
            ],[
              'name'  => 'id_sekolah',
              'contents'  => $idschool,
            ],
          ],]);
          if ($Update) {
            return redirect()->route('spp.index')->with(['response' => 'success', 'message' => 'Data Pempayaran SPP Berhasil Di Update']);
          } else {
            return redirect()->route('spp.index')->with(['response' => 'error', 'message' => 'Data Pempayaran SPP Gagal Di Update']);
          }
      }else {
        $Update = $CLient->request('PATCH',env('API_URL').'/pembayaran-spp/'.$request->id_tr_spp,[
          'headers' => [ 'Authorization' => $token ],
          'multipart' =>[
            [
              'name' => 'parameter',
              'contents' => $request->parameter,
            ],[
              'name'  => 'biaya_bulanan',
              'contents' => $request->biaya_bulanan,
            ],[
              'name' => 'keterlambatan',
              'contents' => $request->keterlambatan,
            ],[
              'name' => 'total_pembayaran',
              'contents' => $request->biaya_bulanan * ($request->keterlambatan + 1),
            ],[
              'name'  => 'id_siswa',
              'contents'  => $request->id_siswa,
            ],[
              'name'  => 'id_sekolah',
              'contents'  => $idschool,
            ],
          ],]);
          if ($Update) {
            return redirect()->route('spp.index')->with(['response' => 'success', 'message' => 'Data Pempayaran SPP Berhasil Di Update']);
          } else {
            return redirect()->route('spp.index')->with(['response' => 'error', 'message' => 'Data Pempayaran SPP Gagal Di Update']);
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
      $client->request('DELETE', env('API_URL') . '/pembayaran-spp/' . $id, [
        'headers' => [
          'Authorization' => $get_token
        ]
      ]);
      if ($client) {
        return redirect()->route('spp.index')->with(['response' => 'success', 'message' => 'Data Pempayaran SPP Berhasil Dihapus']);
      } else {
        return redirect()->route('spp.index')->with(['response' => 'error', 'message' => 'Data Pempayaran SPP Gagal Dihapus']);
      }
    }
    public function getstudent()
    {
      $token     = session()->get('token');
      $idsekolah     = session()->get('sekolah')['id_sekolah'];
      $client    = new Client();
      $get_data_student = $client->request('GET',env('API_URL').'/siswa?id_sekolah='.$idsekolah, [
       'headers' => ['Authorization'     => $token ]
     ]);
      $class = json_decode($get_data_student->getBody()->getContents());
      return collect($class)->whereIn('id_sekolah',$idsekolah);
    }
}
