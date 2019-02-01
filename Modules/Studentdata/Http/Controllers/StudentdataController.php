<?php

namespace Modules\Studentdata\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
class StudentdataController extends Controller
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
           $get_student = $client->request('GET',env('API_URL').'/siswa?id_sekolah='.$idsekolah, [
                  'headers' => ['Authorization'     => $token ]
               ]);
           $student_data = json_decode($get_student->getBody()->getContents());
        return view('studentdata::index',compact('student_data'));
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
        $get_kelas = $client->request('GET',env('API_URL').'/kelas?id_sekolah='.$idsekolah, [
            'headers' => ['Authorization'     => $token ]
        ]);
        $class_data = json_decode($get_kelas->getBody()->getContents());
        return view('studentdata::create',['kelasdata'=>$class_data]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'nisn' => 'required|unique:siswa',
      ]);

      $gambar = $request->file('image');
      $nm_file = $gambar->getClientOriginalName();
      $client = new Client();
      $token = session('token');
      $idsekolah = session()->get('sekolah')['id_sekolah'];
      // dd($token);
      $res = $client->post(env('API_URL').'/siswa',[
        'headers' => [
            'Authorization'     => $token
        ],
          'multipart' => [
            [
                'name' => 'nisn',
                'contents'=>$request->nisn,
            ],
            [
                'name' => 'nama_siswa',
                'contents'=>$request->nama_siswa,
            ],
            [
                'name' => 'alamat',
                'contents'=>$request->alamat,
            ],
            [
                'name' => 'nomor_tlp',
                'contents'=>$request->no_telepon_siswa,
            ],
            [
                'name' => 'foto',
                'contents'=> 'siswafoto/'.$nm_file,
            ],
            [
                'name' => 'foto',
                'contents'=>fopen($gambar, 'r'),
                'filename'  => $nm_file
            ],
            [
                'name' => 'nama_ibu',
                'contents'=>$request->nama_ibu,
            ],
            [
                'name' => 'nama_ayah',
                'contents'=>$request->nama_ayah,
            ],
            [
                'name' => 'jenis_kelamin',
                'contents'=>$request->jenis_kelamin,
            ],
            [
                'name' => 'tlp_ibu',
                'contents'=>$request->no_telepon_ibu,
            ],
            [
                'name' => 'tlp_ayah',
                'contents'=>$request->no_telepon_ayah,
            ],
            [
                'name' => 'tempat_lahir',
                'contents'=>$request->tempat_lahir,
            ],
            [
                'name' => 'tgl_lahir',
                'contents'=>$request->tanggal_lahir,
            ],
            [
                'name' => 'id_sekolah',
                'contents'=>$idsekolah
            ],
            [
                'name' => 'id_kelas',
                'contents'=>$request->nama_kelas,
            ]
         ]
      ]);

        if ($res) {
            return redirect('studentdata')->with(['response' => 'success', 'message' => 'Data Siswa Berhasil Ditambah']);
        } else {
            return redirect('studentdata')->with(['response' => 'error', 'message' => 'Data Siswa Gagal Ditambah']);
        }
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('studentdata::show');
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
      $get_data_kelas=$client->request('GET',env('API_URL').'/kelas?id_sekolah='.session()->get('sekolah')['id_sekolah'], [
      'headers' => [
      'Authorization' => $token
      ]
      ]);
      // get data siswa
      $get_data_siswa=$client->request('GET',env('API_URL').'/siswa/'.$id, [
      'headers' => [
      'Authorization' => $token
      ]
      ]);
      $datakelas = json_decode($get_data_kelas->getBody()->getContents());
      $datasiswa = json_decode($get_data_siswa->getBody()->getContents());
      return view('studentdata::edit',['datasiswa' => $datasiswa, 'datakelas' => $datakelas]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
      $request->validate([
        'nisn' => 'required|unique:siswa,nisn,'.$request->id_siswa.',id_siswa',
      ]);

      $token = session()->get('token');
      $client = new Client();
      $headers = ['Authorization' => $token];

      if ($request->file('foto')) {
        $validate = $request->validate([
            'foto' => 'mimes:jpeg,png',
        ]);

        $send = $client->request('PATCH',env('API_URL').'/siswa/'.$request->id_siswa,
        [
        'headers' => [
        'Authorization' => $headers
        ],
        'multipart' => [
          [
              'name' => 'foto',
              'contents' => 'siswafoto/'.$request->file('foto')->getClientOriginalName()
          ],
          [
              'name' => 'foto',
              'contents'=>fopen($request->file('foto'), 'r'),
              'filename'  => $request->file('foto')->getClientOriginalName()
          ]
        ]
        ]);
      }

      $send = $client->request('PATCH',env('API_URL').'/siswa/'.$request->id_siswa,
      [
      'headers' => [
      'Authorization' => $headers
      ],
      'multipart' => [
        [
            'name' => 'nisn',
            'contents' => $request->nisn
        ],
        [
            'name' => 'nama_siswa',
            'contents' => $request->nama_siswa
        ],
        [
            'name' => 'alamat',
            'contents' => $request->alamat
        ],
        [
            'name' => 'nomor_tlp',
            'contents' => $request->nomor_tlp
        ],
        [
            'name' => 'nama_ibu',
            'contents' => $request->nama_ibu
        ],
        [
            'name' => 'nama_ayah',
            'contents' => $request->nama_ayah
        ],
        [
            'name' => 'tlp_ayah',
            'contents' => $request->tlp_ayah
        ],
        [
            'name' => 'tlp_ibu',
            'contents' => $request->tlp_ibu
        ],
        [
            'name' => 'tempat_lahir',
            'contents' => $request->tempat_lahir
        ],
        [
            'name' => 'tgl_lahir',
            'contents' => $request->tgl_lahir
        ],
        [
            'name' => 'jenis_kelamin',
            'contents' => $request->jenis_kelamin
        ],
        [
            'name' => 'id_sekolah',
            'contents' => session()->get('sekolah')['id_sekolah']
        ],
        [
            'name' => 'id_kelas',
            'contents' => $request->id_kelas
        ]
      ]
      ]);

        if ($send) {
            return redirect('studentdata')->with(['response' => 'success', 'message' => 'Data Siswa Berhasil Diubah']);
        } else {
            return redirect('studentdata')->with(['response' => 'error', 'message' => 'Data Siswa Gagal Diubah']);
        }

    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        // dd($id);
        $get_token = session()->get('token');
        $client = new Client();
        $fuc= $client->request('DELETE', env('API_URL') . '/siswa/' .$id , [
            'headers' => [
                'Authorization' => $get_token
                ]
                ]);

        if ($fuc) {
            return redirect('studentdata')->with(['response' => 'success', 'message' => 'Data Siswa Berhasil Dihapus']);
        } else {
            return redirect('studentdata')->with(['response' => 'error', 'message' => 'Data Siswa Gagal Dihapus']);
        }
     }
}
