<?php

namespace Modules\Lesson\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $token     = session()->get('token');
        $idschool = session()->get('sekolah')['id_sekolah'];
        $client    = new Client();
        $get_lesson = $client->request('GET',env('API_URL').'/matapelajaran/', [
              'headers' => ['Authorization' => $token ]
            ]);
        $lesson = json_decode($get_lesson->getBody()->getContents());
        $lesson_data = collect($lesson)->whereIn('id_sekolah',$idschool);
        return view('lesson::index',compact('lesson_data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('lesson::create');
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
          $idschool = session()->get('sekolah')['id_sekolah'];
          $res = $client->post(env('API_URL').'/matapelajaran',[
            'headers' => [
                'Authorization'     => $token
            ],
              'form_params' => [
                'nama_mapel' => $request->lesson_name,
                'id_sekolah' => $idschool,
             ]
          ]);


        if ($res) {
            return redirect('lesson')->with(['response' => 'success', 'message' => 'Data Pelajaran Berhasil Ditambah']);
        } else {
            return redirect('lesson')->with(['response' => 'error', 'message' => 'Data Pelajaran Gagal Ditambah']);
        }
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('lesson::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $token = session()->get('token');
        $client= new Client();
        $get_data_lesson = $client->request('GET',env('API_URL').'/matapelajaran/'.$request->id_mapel, [
          'headers' => [
            'Authorization' => $token
          ],
        ]);
        $datalesson = json_decode($get_data_lesson->getBody()->getContents());
        return view('lesson::edit',compact('datalesson','dataSekolah'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)  {
        $token = session()->get('token');
        $idschool = session()->get('sekolah')['id_sekolah'];
        $client = new Client();
        $update_lesson = $client->request('PATCH',env('API_URL').'/matapelajaran/'.$request->id_mapel,[
          'headers' => [
            'Authorization' => $token,
          ],
          'form_params' => [
              'nama_mapel'  => $request->nama_mapel,
              'id_sekolah'  => $idschool,
          ],
        ]);

        if ($update_lesson) {
            return redirect('lesson')->with(['response' => 'success', 'message' => 'Data Pelajaran Berhasil Diubah']);
        } else {
            return redirect('lesson')->with(['response' => 'error', 'message' => 'Data Pelajaran Gagal Diubah']);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $get_token = session()->get('token');
        $idschool = session()->get('sekolah')['id_sekolah'];
        $client = new Client();
        $get_data_schedule = $client->request('GET',env('API_URL').'/jadwal?id_sekolah='.$idschool.'&id_kelas='.$id, [
          'headers' => ['Authorization'     => $get_token ]
           ]);
        $schedule = json_decode($get_data_schedule->getBody()->getContents());
        if ($schedule != null) {
          return redirect('lesson')->with(['response' => 'error', 'message' => 'Data Kelas Gagal Dihapus Karena data sedang digunakan oleh data Jadwal']);
        }else {
            $client->request('DELETE', env('API_URL') . '/matapelajaran/' .$id , [
                'headers' => [ 'Authorization' => $get_token ]
                ]);
            if($client){
              return redirect('lesson')->with(['response'=> 'success', 'message' => 'Data Pelajaran Berhasil Dihapus']);
            }else{
              return redirect('lesson')->with(['response' => 'error', 'message' => 'Data Pelajaran Gagal Dihapus']);
            }
        }
    }
}
