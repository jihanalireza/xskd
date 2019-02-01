<?php

namespace Modules\Task\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Input;

class TaskController extends Controller
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
        $get_data_taks = $client->request('GET',env('API_URL').'/tugas?id_sekolah='.$idsekolah, [
              'headers' => ['Authorization'     => $token ]
           ]);
        $task = json_decode($get_data_taks->getBody()->getContents());

        return view('task::index', compact('task'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
      $token     = session()->get('token');
      $client    = new Client();
      $idsekolah = session()->get('sekolah')['id_sekolah'];
      $get_data_sekolah = $client->request('GET',env('API_URL').'/sekolah', [
            'headers' => ['Authorization'     => $token ]
         ]);
      $get_data_guru = $client->request('GET',env('API_URL').'/guru?id_sekolah='.$idsekolah, [
            'headers' => ['Authorization'     => $token ]
         ]);
      $get_data_kelas = $client->request('GET',env('API_URL').'/kelas?id_sekolah='.$idsekolah, [
            'headers' => ['Authorization'     => $token ]
         ]);
      $sekolah = json_decode($get_data_sekolah->getBody()->getContents());
      $guru = json_decode($get_data_guru->getBody()->getContents());
      $kelas = json_decode($get_data_kelas->getBody()->getContents());

      return view('task::create', compact('sekolah','kelas','guru'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
      $gambar = $request->file('attachment');
      $nm_file = $gambar->getClientOriginalName();
      $client = new Client();
      $value = session('token');
      $res = $client->post(env('API_URL').'/tugas',[
      'headers' => [
          'Authorization'     => $value
      ],
       'multipart' => [
         [
             'name' => 'judul_tugas',
             'contents'=>$request->judul_tugas,
         ],
         [
           'name' => 'attachment',
           'contents'=> 'attachmenttugas/'.$nm_file,
         ],
         [
           'name' => 'attachment',
           'contents'=>fopen($gambar, 'r'),
           'filename'  => $nm_file
         ],
         [
           'name' => 'deskripsi',
           'contents'=>$request->deskripsi,
         ],
         [
             'name' => 'id_sekolah',
             'contents'=> session()->get('sekolah')['id_sekolah'],
         ],
         [
             'name' => 'id_guru',
             'contents'=> $request->guru,
         ],
         [
             'name' => 'id_kelas',
             'contents'=>$request->id_kelas,
         ]
      ]
      ]);

    if ($res) {
        $notification = "Tugas Baru Telah Ditambahkan";
        $response = $this->sendMessage($notification);
        $return["allresponses"] = $response;
        $return = json_encode($return);

        return redirect('task')->with( ['response' => 'success', 'message' => 'Data Tugas Berhasil Ditambah']);
    } else {
        return redirect('task')->with( ['response' => 'error', 'message' => 'Data Tugas Gagal Ditambah']);
    }
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('task::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $token = session()->get('token');
        $client = new Client();
        $get_task = $client->request('GET',env('API_URL').'/tugas/'.$id,[
          'headers' => [
            'Authorization' => $token
          ],
        ]);
        $get_data_guru = $client->request('GET',env('API_URL').'/guru', [
            'headers' => ['Authorization' => $token ]
        ]);
        $get_data_kelas = $client->request('GET',env('API_URL').'/kelas', [
            'headers' => ['Authorization' => $token ]
        ]);

        $guru = json_decode($get_data_guru->getBody()->getContents());
        $kelas = json_decode($get_data_kelas->getBody()->getContents());
        $data_task = json_decode($get_task->getBody()->getContents());

        return view('task::update',compact('data_task','kelas','guru'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request,$id)
    {
        $file = $request->file('attachment');

        $token = session()->get('token');
        $client = new Client();
        $headers = ['Authorization' => $token];

        if (!is_null($file)) {

          $file_name = $file->getClientOriginalName();
          $send = $client->request('PATCH',env('API_URL').'/tugas/'.$id,
            [
            'headers' => [
                'Authorization' => $headers
            ],
            'multipart' => [
                 [
                   'name' => 'judul_tugas',
                   'contents'=>$request->judul_tugas,
                 ],
                 [
                   'name' => 'attachment',
                   'contents'=> 'attachmenttugas/'.$file_name,
                 ],
                 [
                   'name' => 'attachment',
                   'contents'=>fopen($file, 'r'),
                   'filename'  => $file_name
                 ],
                 [
                   'name' => 'deskripsi',
                   'contents'=>$request->deskripsi,
                 ],
                 [
                     'name' => 'id_sekolah',
                     'contents'=>'1',
                 ],
                 [
                     'name' => 'id_guru',
                     'contents'=>$request->id_guru,
                 ],
                 [
                     'name' => 'id_kelas',
                     'contents'=>$request->id_kelas,
                 ],
              ]
          ]);
      }
      else{
          $send = $client->request('PATCH',env('API_URL').'/tugas/'.$id,
            [
            'headers' => [
                'Authorization' => $headers
            ],
            'multipart' => [
                 [
                   'name' => 'judul_tugas',
                   'contents'=>$request->judul_tugas,
                 ],
                 [
                   'name' => 'deskripsi',
                   'contents'=>$request->deskripsi,
                 ],
                 [
                     'name' => 'id_sekolah',
                     'contents'=>'1',
                 ],
                 [
                     'name' => 'id_guru',
                     'contents'=>$request->id_guru,
                 ],
                 [
                     'name' => 'id_kelas',
                     'contents'=>$request->id_kelas,
                 ],
              ]
          ]);
      }

        if ($send) {
            return redirect('task')->with(['response' => 'success', 'message' => 'Data Tugas Berhasil Diubah']);
        } else {
            return redirect('task')->with(['response' => 'error', 'message' => 'Data Tugas Gagal Diubah']);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)  {
        $token = session()->get('token');
        $client = new Client();
        $del = $client->request('DELETE',env('API_URL').'/tugas/'.$id,[
          'headers' => [
            'Authorization' => $token,
          ]
        ]);
        if($del){
          return redirect('task')->with(['response'=> 'success', 'message' => 'Data Tugas Berhasil Dihapus']);
        }else{
          return redirect('task')->with(['response' => 'error', 'message' => 'Data Tugas Gagal Dihapus']);
        }
    }
    public function getlesson()
    {
       $token     = session()->get('token');
       $idsekolah     = session()->get('idsekolah');
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
       $idsekolah     = session()->get('idsekolah');
       $client    = new Client();
       $get_data_class = $client->request('GET',env('API_URL').'/kelas', [
          'headers' => ['Authorization'     => $token ]
      ]);
       $class = json_decode($get_data_class->getBody()->getContents());
       return collect($class)->whereIn('id_sekolah',$idsekolah);
   }

   public function getteacher()
   {
       $token     = session()->get('token');
       $idsekolah     = session()->get('idsekolah');
       $client    = new Client();
       $get_data_class = $client->request('GET',env('API_URL').'/guru', [
          'headers' => ['Authorization'     => $token ]
      ]);
       $class = json_decode($get_data_class->getBody()->getContents());
       return collect($class)->whereIn('id_sekolah',$idsekolah);
   }

    public function sendMessage($notification)
    {
        $content = array(
            "en" => $notification
        );
        $hashes_array = array();

        $fields = array(
            'app_id' => "8ac2f222-9a1c-45f7-8d2f-400f531e7844",
            'included_segments' => array(
                'All'
            ),
            'data' => array(
                "foo" => "bar"
            ),
            'contents' => $content,
            'web_buttons' => $hashes_array
        );

        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic NGNmZTE2MmEtZDRjYy00YTQyLWE5NGQtZmEyMWM0NjJiNjMw'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

}
