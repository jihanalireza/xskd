<?php

namespace Modules\Score\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {   
        $idschool = session()->get('sekolah')['id_sekolah'];
        $token     = session()->get('token');
        $client    = new Client();
        $get_score = $client->request('GET',env('API_URL').'/nilai/', [
              'headers' => ['Authorization' => $token ]
            ]);
  
        $score = json_decode($get_score->getBody()->getContents());
        $score_data = collect($score)->whereIn('id_sekolah',$idschool);
        return view('score::index',compact('score_data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
      $dataclass = $this->getclass();
      $datastudent = $this->getsiswa();

      $data = array(
        'dataclass' => $dataclass,
        'datastudent' => $datastudent
      );

      return view('score::create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
      // dd($request->all());
      $validateStore = $request->validate([
          'id_kelas' => 'required',
          'id_siswa' => 'required',
          'uts' => 'required',
          'uas' => 'required',
          'tugas' => 'required',
          'ulangan_harian' => 'required',
      ]);

      $client = new Client();
      $value = session()->get('token');
      $idsekolah     = session()->get('sekolah')['id_sekolah'];
      $total = $request->uts + $request->uas + $request->tugas + $request->ulangan_harian;
      $res = $client->post(env('API_URL').'/nilai',[
        'headers' => [
            'Authorization'     => $value
        ],
          'form_params' => [
            'uts'             => $request->uts,
            'uas'             => $request->uas,
            'tugas'           => $request->tugas,
            'ulangan_harian'  => $request->ulangan_harian,
            'total_nilai'     => $total / 4,
            'id_kelas'        => $request->id_kelas,
            'id_siswa'        => $request->id_siswa,
            'id_sekolah'      => $idsekolah,
            'id_guru'         => session()->get('sekolah')['id_guru']
          ]
      ]);
      if ($client) {
            return redirect('score')->with(['response' => 'success', 'message' => 'Data Nilai Berhasil Ditambah']);
        } else {
            return redirect('score')->with(['response' => 'error', 'message' => 'Data Nilai Gagal Ditambah']);
        }

    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
      return view('score::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
      $token = session()->get('token');
      $client = new Client();
      // get data kelas based on id sekolah
      $get_data_score=$client->request('GET',env('API_URL').'/nilai/'.$id, [
        'headers' => [
          'Authorization' => $token
        ]
      ]);
      $dataclass = $this->getclass();
      $datastudent = $this->getsiswa();
      $datascore = json_decode($get_data_score->getBody()->getContents());
      $data = array(
        'dataclass' => $dataclass,
        'datastudent' => $datastudent,
        'datascore' => $datascore
      );
      return view('score::edit',$data);
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
      $total = $request->uts + $request->uas + $request->tugas + $request->ulangan_harian;
      $send = $client->request('PATCH',env('API_URL').'/nilai/'.$request->id_nilai,
        [
          'headers' => [
            'Authorization' => $headers
          ],
          'form_params' => [
            'uts' => $request->uts,
            'uas' => $request->uas,
            'tugas' => $request->tugas,
            'ulangan_harian' => $request->ulangan_harian,
            'total_nilai' => $total / 4,
            'id_siswa' => $request->id_siswa,
            'id_sekolah' => session()->get('sekolah')['id_sekolah'],
            'id_kelas' => $request->id_kelas,
            'id_guru' =>session()->get('sekolah')['id_guru'] ,
          ]
        ]);

      return redirect()->route('indexScoredata');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
      $get_token = session()->get('token');
      $client = new Client();
      $client->request('DELETE', env('API_URL') . '/nilai/' . $id, [
        'headers' => [
          'Authorization' => $get_token
        ]
      ]);
      if ($client) {
        return redirect()->route('indexScoredata')->with(['response' => 'success', 'message' => 'Data Nilai Berhasil Dihapus']);
      } else {
        return redirect()->route('indexScoredata')->with(['response' => 'error', 'message' => 'Data Nilai Gagal Dihapus']);
      }
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

    public function showsiswa(Request $request)
    {
      $token     = session()->get('token');
      $client    = new Client();
      $get_data_class = $client->request('GET',env('API_URL').'/siswa?id_kelas='.$request->param, [
         'headers' => ['Authorization'     => $token ]
      ]);
      $kelas = json_decode($get_data_class->getBody()->getContents());
      return $kelas;
    }
  }
