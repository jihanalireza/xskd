<?php

namespace Modules\Schedule\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
       $token     = session()->get('token');
       $client    = new Client();
       $idsekolah     = session()->get('sekolah')['id_sekolah'];
       $get_data_schedule = $client->request('GET',env('API_URL').'/jadwal?id_sekolah='.$idsekolah, [
          'headers' => ['Authorization'     => $token ]
      ]);
       $schedule = json_decode($get_data_schedule->getBody()->getContents());

       return view('schedule::index',compact('schedule'));
   }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {

        $datalesson = $this->getlesson();
        $dataclass = $this->getclass();

        $data = array(
            'datalesson' => $datalesson,
            'dataclass' => $dataclass
        );

        return view('schedule::create',$data);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validateStore = $request->validate([
            'mata_pelajaran' => 'required',
            'kelas' => 'required',
            'jam_masuk' => 'required',
            'jam_selesai' => 'required',
            'hari' => 'required',
        ]);

        $client = new Client();
        $value = session('token');
        $idsekolah     = session()->get('sekolah')['id_sekolah'];
        $res = $client->post(env('API_URL').'/jadwal',[
        'headers' => [
            'Authorization'     => $value
        ],
          'form_params' => [
            'jam_masuk'     =>  $request->jam_masuk,
            'jam_selesai'   =>  $request->jam_selesai,
            'hari'          =>  $request->hari,
            'id_mapel'      =>  $request->mata_pelajaran,
            'id_sekolah'    =>  $idsekolah,
            'id_kelas'      =>  $request->kelas
         ]
        ]);

        if ($client) {
            return redirect('schedule')->with(['response' => 'success', 'message' => 'Data Jadwal Berhasil Ditambah']);
        } else {
            return redirect('schedule')->with(['response' => 'error', 'message' => 'Data Jadwal Gagal Ditambah']);
        }
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('schedule::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $datalesson = $this->getlesson();
        $dataclass = $this->getclass();

        $token     = session()->get('token');
        $idsekolah     = session()->get('sekolah')['id_sekolah'];
        $client    = new Client();
        $get_data_schedule = $client->request('GET',env('API_URL').'/jadwal/'.$id, [
          'headers' => ['Authorization'     => $token ]
      ]);
        $dataschedule = json_decode($get_data_schedule->getBody()->getContents());


        $data = array(
            'datalesson' => $datalesson,
            'dataclass' => $dataclass,
            'dataschedule' => $dataschedule
        );
        return view('schedule::edit',$data);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($id,Request $request)
    {
        $validateUpdate = $request->validate([
            'mata_pelajaran' => 'required',
            'kelas' => 'required',
            'jam_masuk' => 'required',
            'jam_selesai' => 'required',
            'hari' => 'required',
        ]);

        $client = new Client();
        $token = session()->get('token');
        $idsekolah = session()->get('sekolah')['id_sekolah'];
        $res = $client->put(env('API_URL').'/jadwal/'.$id,[
            'headers' => [
                'Authorization'     => $token
            ],
            'form_params' => [
                'id_sekolah'      =>  $idsekolah,
                'id_kelas'      =>  $request->kelas,
                'id_mapel'      =>  $request->mata_pelajaran,
                'jam_masuk'     =>  $request->jam_masuk,
                'jam_selesai'   =>  $request->jam_selesai,
                'hari'          =>  $request->hari
            ]
        ]);

        if ($res) {
            return redirect('schedule')->with(['response' => 'success', 'message' => 'Data Jadwal Berhasil Diubah']);
        } else {
            return redirect('schedule')->with(['response' => 'error', 'message' => 'Data Jadwal Gagal Diubah']);
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
        $client->request('DELETE', env('API_URL') . '/jadwal/' . $id, [
            'headers' => [
                'Authorization' => $get_token
            ]
        ]);
        if($client){
            return redirect('schedule')->with(['response'=> 'success', 'message' => 'Data Jadwal Berhasil Dihapus']);
        }else{
            return redirect('schedule')->with(['response' => 'error', 'message' => 'Data Jadwal Gagal Dihapus']);
        }

    }

    public function getlesson()
    {

       $token     = session()->get('token');
       $idsekolah     = session()->get('sekolah')['id_sekolah'];
       //$idsekolah = 1;
       $client    = new Client();
       $get_data_lesson = $client->request('GET',env('API_URL').'/matapelajaran', [
          'headers' => ['Authorization'     => $token ]
       ]);
       $lesson = json_decode($get_data_lesson->getBody()->getContents());
       return collect($lesson)->whereIn('id_sekolah',$idsekolah);
   }

   public function getclass()
   {
       $token     = session()->get('token');
       $idsekolah     = session()->get('sekolah')['id_sekolah'];
      //$idsekolah = 1;
       $client    = new Client();
       $get_data_class = $client->request('GET',env('API_URL').'/kelas', [
          'headers' => ['Authorization'     => $token ]
      ]);
       $class = json_decode($get_data_class->getBody()->getContents());
       return collect($class)->whereIn('id_sekolah',$idsekolah);
   }
}
