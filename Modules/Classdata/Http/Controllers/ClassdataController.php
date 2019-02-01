<?php

namespace Modules\Classdata\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

class ClassdataController extends Controller
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
        $get_data_class = $client->request('GET',env('API_URL').'/kelas', [
          'headers' => ['Authorization'     => $token ]
        ]);

        $getContents = json_decode($get_data_class->getBody()->getContents());
        $dataclass = collect($getContents)->whereIn('id_sekolah',$idschool);

        $data = array(
            'dataclass' => $dataclass
        );
       return view('classdata::index',$data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('classdata::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
      // dd($request->all());
      $client = new Client();
      $token = session('token');
      $res = $client->post(env('API_URL').'/kelas',[
        'headers' => [
            'Authorization'     => $token
        ],
          'form_params' => [
            'nama_kelas' => $request->nama_kelas,
            'id_sekolah' => session()->get('sekolah')['id_sekolah'],
         ]
      ]);

    if ($res) {
      return redirect()->route('indexClassdata')->with(['response' => 'success', 'message' => 'Data Kelas Berhasil Ditambah']);
    } else {
      return redirect()->route('indexClassdata')->with(['response' => 'error', 'message' => 'Data Kelas Gagal Ditambah']);
    }
    
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('classdata::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
      $token = session()->get('token');
     $client = new Client();
     $get_Classdata = $client->request('GET',env('API_URL').'/kelas/'.$request->id_kelas,[
       'headers' => [
         'Authorization' => $token,
       ],
     ]);
     $get_data_school = $client->request('GET',env('API_URL').'/sekolah/',[
         'headers' => [
           'Authorization' => $token,
         ]
     ]);
     $dataSekolah = json_decode($get_data_school->getBody()->getContents());
     $Classdata = json_decode($get_Classdata->getBody()->getContents());
       return view('classdata::edit',compact('dataSekolah','Classdata'));

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
      $update_Classdata = $client->request('PATCH',env('API_URL').'/kelas/'.$request->id_kelas,[
        'headers' => [
          'Authorization' => $token,
        ],
        'form_params' => [
          'nama_kelas' => $request->nama_kelas,
        ],
      ])->getBody();

      if ($update_Classdata) {
        return redirect()->route('indexClassdata')->with(['response' => 'success', 'message' => 'Data Kelas Berhasil Diubah']);
      } else {
        return redirect()->route('indexClassdata')->with(['response' => 'error', 'message' => 'Data Kelas Gagal Diubah']);
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
     $get_score = $client->request('GET',env('API_URL').'/nilai?id_sekolah='.$idschool.'&id_kelas='.$id, [
           'headers' => ['Authorization' => $get_token ]
         ]);
     $get_book = $client->request('GET',env('API_URL').'/buku?id_sekolah='.$idschool.'&id_kelas='.$id, [
           'headers' => ['Authorization' => $get_token ]
         ]);
     $get_data_taks = $client->request('GET',env('API_URL').'/tugas?id_sekolah='.$idschool.'&id_kelas='.$id, [
           'headers' => ['Authorization'     => $get_token ]
        ]);
     $get_student = $client->request('GET',env('API_URL').'/siswa?id_sekolah='.$idschool.'&id_kelas='.$id, [
           'headers' => ['Authorization'     => $get_token ]
        ]);
     $get_data_schedule = $client->request('GET',env('API_URL').'/jadwal?id_sekolah='.$idschool.'&id_kelas='.$id, [
       'headers' => ['Authorization'     => $get_token ]
        ]);
     $schedule = json_decode($get_data_schedule->getBody()->getContents());
     $student_data = json_decode($get_student->getBody()->getContents());
     $task = json_decode($get_data_taks->getBody()->getContents());
     $book_data = json_decode($get_book->getBody()->getContents());
     $score = json_decode($get_score->getBody()->getContents());
     if ($schedule != null) {
       return redirect('classdata')->with(['response' => 'error', 'message' => 'Data Kelas Gagal Dihapus Karena data sedang digunakan oleh data Jadwal']);
     }elseif ($student_data != null) {
       return redirect('classdata')->with(['response' => 'error', 'message' => 'Data Kelas Gagal Dihapus Karena data sedang digunakan oleh data Siswa']);
     }elseif ($task != null) {
       return redirect('classdata')->with(['response' => 'error', 'message' => 'Data Kelas Gagal Dihapus Karena data sedang digunakan oleh data Tugas']);
     }elseif ($book_data != null) {
       return redirect('classdata')->with(['response' => 'error', 'message' => 'Data Kelas Gagal Dihapus Karena data sedang digunakan oleh data Buku']);
     }elseif ($score != null) {
       return redirect('classdata')->with(['response' => 'error', 'message' => 'Data Kelas Gagal Dihapus Karena data sedang digunakan oleh data Nilai']);
     }else {
       $client->request('DELETE', env('API_URL') . '/kelas/' . $id, [
         'headers' => [
           'Authorization' => $get_token
         ]
       ]);
       if($client){
         return redirect('classdata')->with(['response'=> 'success', 'message' => 'Data Kelas Berhasil Dihapus']);
       }else{
         return redirect('classdata')->with(['response' => 'error', 'message' => 'Data Kelas Gagal Dihapus']);
       }
     }

    }
}
