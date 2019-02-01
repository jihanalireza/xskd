<?php

namespace Modules\Teacherdata\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

class TeacherdataController extends Controller
{
/**
* Display a listing of the resource.
* @return Response
*/
public function index()
{
    $idschool = session()->get('sekolah')['id_sekolah'];
    $client = new Client();
    $token = session()->get('token');
    $get_data_theacher = $client->request('GET',env('API_URL').'/guru',[
        'headers' => [
            'Authorization' => $token
        ],
    ]);
    $Theacher = json_decode($get_data_theacher->getBody()->getContents());
    $dataTheacher = collect($Theacher)->whereIn('id_sekolah',$idschool);
    return view('teacherdata::index',compact('dataTheacher'));
}

/**
* Show the form for creating a new resource.
* @return Response
*/
public function create()
{
    return view('teacherdata::create');
}

/**
* Store a newly created resource in storage.
* @param  Request $request
* @return Response
*/
public function store(Request $request)
{
    $validateStore = $request->validate([
        'nama_guru' => 'required',
        'alamat' => 'required',
        'email' => 'required',
        'nomor_telepon' => 'required|max:12',
        'foto' => 'required|mimes:jpeg,png',
    ]);
    $gambar = $request->file('foto');
    $nm_file = $gambar->getClientOriginalName();
    $token = session()->get('token');
    $idschool = session()->get('sekolah')['id_sekolah'];
    $client = new Client();
    $headers = ['Authorization' => $token];
    $send = $client->request('POST',env('API_URL').'/guru',
    [
    'headers' => [
        'Authorization' => $headers
    ],
        'multipart' => [
            [
                'name' => 'nama_guru',
                'contents' => $request->nama_guru
            ],
            [
                'name' => 'alamat',
                'contents' => $request->alamat
            ],
            [
                'name' => 'email',
                'contents' => $request->email
            ],
            [
                'name' => 'nomor_tlp',
                'contents' => $request->nomor_telepon
            ],
            [
                'name' => 'foto',
                'contents' => 'gurufoto/'.$nm_file
            ],
            [
                'name' => 'foto',
                'contents'=>fopen($gambar, 'r'),
                'filename'  => $nm_file
            ],
            [
                'name' => 'id_sekolah',
                'contents' => $idschool
            ],
        ]
    ]);

    if ($client) {
        return redirect('teacherdata')->with(['response' => 'success', 'message' => 'Data Guru Berhasil Ditambah']);
    } else {
        return redirect('teacherdata')->with(['response' => 'error', 'message' => 'Data Guru Gagal Ditambah']);
    }
}

/**
* Show the specified resource.
* @return Response
*/
public function show()
{
    return view('teacherdata::show');
}

/**
* Show the form for editing the specified resource.
* @return Response
*/

public function edit($id)
{
  $token = session()->get('token');
  $client = new Client();
  $get_data_teacher = $client->request('GET',env('API_URL').'/guru/'.$id,[
    'headers' => [
      'Authorization' => $token
    ],
  ]);
  $dataTeacher = json_decode($get_data_teacher->getBody()->getContents());
    return view('teacherdata::edit',['dataTheacher'=>$dataTeacher]);
}

/**
* Update the specified resource in storage.
* @param  Request $request
* @return Response
*/
public function update(Request $request, $id)
{
  $validateStore = $request->validate([
      'name' => 'required',
      'address' => 'required',
      'email' => 'required',
      'phonenumber' => 'required',
  ]);

  if ($request->image == null) {
        $token = session()->get('token');
        $idschool = session()->get('sekolah')['id_sekolah'];
        $client = new Client();
        $headers = ['Authorization' => $token];
        $send = $client->request('PATCH',env('API_URL').'/guru/'.$id,
          [
          'headers' => [
              'Authorization' => $headers
          ],
          'multipart' => [
              [
                  'name' => 'nama_guru',
                  'contents' => $request->name
              ],
              [
                  'name' => 'alamat',
                  'contents' => $request->address
              ],
              [
                  'name' => 'email',
                  'contents' => $request->email
              ],
              [
                  'name' => 'nomor_tlp',
                  'contents' => $request->phonenumber
              ],
              [
                  'name' => 'foto',
                  'contents' => $request->imagedefault
              ],
              [
                  'name' => 'id_sekolah',
                  'contents' => $idschool
              ],
            ]
        ]);
    }else{
      $gambar = $request->file('image');
      $nm_file = $gambar->getClientOriginalName();
      $token = session()->get('token');
      $idschool = session()->get('sekolah')['id_sekolah'];
      $client = new Client();
      $headers = ['Authorization' => $token];
      $send = $client->request('PATCH',env('API_URL').'/guru/'.$id,
        [
        'headers' => [
            'Authorization' => $headers
        ],
        'multipart' => [
            [
                'name' => 'nama_guru',
                'contents' => $request->name
            ],
            [
                'name' => 'alamat',
                'contents' => $request->address
            ],
            [
                'name' => 'email',
                'contents' => $request->email
            ],
            [
                'name' => 'nomor_tlp',
                'contents' => $request->phonenumber
            ],
            [
                'name' => 'foto',
                'contents' => 'gurufoto/'.$nm_file
            ],
            [
                'name' => 'foto',
                'contents'=>fopen($gambar, 'r'),
                'filename'  => $nm_file
            ],
            [
                'name' => 'id_sekolah',
                'contents' => $idschool
            ],
          ]
      ]);
    }

    if ($client) {
        return redirect('teacherdata')->with(['response' => 'success', 'message' => 'Data Guru Berhasil Diubah']);
    } else {
        return redirect('teacherdata')->with(['response' => 'error', 'message' => 'Data Guru Gagal Diubah']);
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
    $client->request('DELETE', env('API_URL') . '/guru/' . $id, [
        'headers' => [
            'Authorization' => $get_token
        ]
    ]);
    if ($client) {
        return redirect('teacherdata')->with(['response' => 'success', 'message' => 'Data Guru Berhasil Dihapus']);
    } else {
        return redirect('teacherdata')->with(['response' => 'error', 'message' => 'Data Guru Gagal Dihapus']);
    }
}
}
