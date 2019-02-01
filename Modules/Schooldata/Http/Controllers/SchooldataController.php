<?php

namespace Modules\Schooldata\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

class SchooldataController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
       $token     = session()->get('token');
       $client    = new Client();
       $get_data_school = $client->request('GET',env('API_URL').'/sekolah', [
          'headers' => ['Authorization'     => $token ]
      ]);
       $dataschool = json_decode($get_data_school->getBody()->getContents());

       $data = array(
        'dataschool' => $dataschool
    );
       return view('schooldata::index',$data);
   }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('schooldata::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
      $validateStore = $request->validate([
        'nama_sekolah' => 'required',
        'alamat' => 'required',
        'nomor_tlp' => 'required|max:12',
        'logo' => 'required|mimes:jpeg,png',
      ]);
      $logo = $request->file('logo');
      // dd($logo);
      $nm_logo = $logo->getClientOriginalName();
      $token = session()->get('token');
      $client = new Client();
      $headers = ['Authorization' => $token];
      $send = $client->request('POST',env('API_URL').'/sekolah',
      [
        'headers' => [
          'Authorization' => $headers
        ],
          'multipart' => [
          [  
            'name' => 'nama_sekolah',
            'contents' => $request->nama_sekolah
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
            'name' => 'logo',
            'contents' => 'sekolahfoto/'.$nm_logo
          ],
          [
            'name' => 'logo',
            'contents'=>fopen($logo, 'r'),
            'filename'  => $nm_logo
          ],
        ]
      ]);

      if ($client) {
          return redirect()->route('indexSchooldata')->with(['response' => 'success', 'message' => 'Data Sekolah Berhasil Ditambah']);
      } else {
          return redirect()->route('indexSchooldata')->with(['response' => 'error', 'message' => 'Data Sekolah Gagal Ditambah']);
      }
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('schooldata::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $token = session()->get('token');
        $client = new Client();
        $get_data=$client->request('GET',env('API_URL').'/sekolah/'.$id, [
        'headers' => [
            'Authorization' => $token
        ]
        ]);
        $school_data = json_decode($get_data->getBody()->getContents());
        // dd($school_data);
        return view('schooldata::update',compact('school_data'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request,$id)
    {
            $logo = $request->file('logo');
            $token = session()->get('token');
            $client = new Client();
            $headers = ['Authorization' => $token];

        if (is_null($logo)) {

            $send = $client->request('PATCH',env('API_URL').'/sekolah/'.$id,
              [

              'headers' => [
                  'Authorization' => $headers
              ],

              'multipart' => [
                  [
                      'name' => 'nama_sekolah',
                      'contents' => $request->school_name
                  ],
                  [
                      'name' => 'alamat',
                      'contents' => $request->school_address
                  ],
                  [
                      'name' => 'nomor_tlp',
                      'contents' => $request->phone_number
                  ],
                ]
            ]);

        }else{
          
          $file_name = $logo->getClientOriginalName();

          $send = $client->request('PATCH',env('API_URL').'/sekolah/'.$id,
            [
            'headers' => [
                'Authorization' => $headers
            ],
            'multipart' => [
                [
                  'name' => 'nama_sekolah',
                  'contents' => $request->school_name
                ],
                [
                  'name' => 'alamat',
                  'contents' => $request->school_address
                ],
                [
                  'name' => 'nomor_tlp',
                  'contents' => $request->phone_number
                ],
                [
                    'name' => 'logo',
                    'contents' => 'sekolahfoto/'.$file_name
                ],
                [
                    'name' => 'logo',
                    'contents'=>fopen($logo, 'r'),
                    'filename'  => $file_name
                ]
              ]
          ]);
        }


        if ($send) {
            return redirect()->route('indexSchooldata')->with(['response' => 'success', 'message' => 'Data Sekolah Berhasil Diubah']);
        } else {
            return redirect()->route('indexSchooldata')->with(['response' => 'error', 'message' => 'Data Sekolah Gagal Diubah']);
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
        $send = $client->request('DELETE', env('API_URL') . '/sekolah/' . $id, [
            'headers' => [
                'Authorization' => $get_token
            ]
        ]);

        if ($send) {
            return redirect()->route('indexSchooldata')->with(['response' => 'success', 'message' => 'Data Sekolah Berhasil Dihapus']);
        } else {
            return redirect()->route('indexSchooldata')->with(['response' => 'error', 'message' => 'Data Sekolah Gagal Dihapus']);
        }

    }
}
