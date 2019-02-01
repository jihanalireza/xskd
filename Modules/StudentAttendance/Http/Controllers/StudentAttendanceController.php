<?php

namespace Modules\StudentAttendance\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Carbon\carbon;

class StudentAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
      $Token = session()->get('token');
      $idschool = session()->get('sekolah')['id_sekolah'];
      $client = new Client();
      $client    = new Client();
      $get_data_class = $client->request('GET',env('API_URL').'/kelas?id_sekolah='.$idschool, [
        'headers' => ['Authorization'     => $Token ]
      ]);
      $Class = json_decode($get_data_class->getBody()->getContents());

      $data = array(
          'Class' => $Class
      );
        return view('studentattendance::index',$data);
    }

    public function show(Request $request)
    {
          $date   = date('Y-m-d');
          $dateIsostart = $date.'T00:00:00.000Z';
          $dateIsoend = $date.'T24:00:00.000Z';

          $token     = session()->get('token');
          $client    = new Client();
          $idsekolah = session()->get('sekolah')['id_sekolah'];
          $get_student = $client->request('GET',env('API_URL').'/siswa?id_sekolah='.$idsekolah.'&id_kelas='.$request->param, [
                'headers' => ['Authorization'     => $token ]
             ]);
          $get_absent = $client->request('GET',env('API_URL').'/absensimurid?id_sekolah='.$idsekolah.'&id_kelas='.$request->param, [
                'headers' => ['Authorization'     => $token ]
             ]);
          $student = json_decode($get_student->getBody()->getContents());
          $absent = json_decode($get_absent->getBody()->getContents());
          $collect = collect($absent);
          $items = $collect->where('createdAt','>=',$dateIsostart)->where('createdAt','<=',$dateIsoend)->all();
          // dd($items);
          // dd(collect($items)->where('id_siswa',1)->isEmpty());
          $data =  array(
            'student' => $student,
            'absent'  => collect($items),
          );
          return response($data);
    }

    public function absent(Request $request)
    {
      if ($request->informationabsent == 'izin') {
        $informationijin = '1';  $informationmasuk = '0';
        $informationsakit = '0';  $informationalfa = '0';
      }elseif ($request->informationabsent == 'sakit') {
        $informationijin = '0';  $informationmasuk = '0';
        $informationsakit = '1';  $informationalfa = '0';
      }elseif ($request->informationabsent == 'masuk') {
        $informationijin = '0';  $informationmasuk = '1';
        $informationsakit = '0';  $informationalfa = '0';
      }elseif ($request->informationabsent == 'alpa') {
        $informationijin = '0';  $informationmasuk = '0';
        $informationsakit = '0';  $informationalfa = '1';
      }

      if ($request->file) {
          $gambar = $request->file('file');
          $nm_file = $gambar->getClientOriginalName();

          $client = new Client();
          $value = session('token');
          $idsekolah     = session()->get('sekolah')['id_sekolah'];
          $res = $client->request('POST',env('API_URL').'/absensimurid',[
          'headers' => [
              'Authorization'     => $value
          ],
          'multipart' => [
              [
                  'name' => 'ijin',
                  'contents' =>$informationijin
              ],
              [
                  'name' => 'sakit',
                  'contents' => $informationsakit
              ],
              [
                  'name' => 'masuk',
                  'contents' => $informationmasuk
              ],
              [
                  'name' => 'alfa',
                  'contents' => $informationalfa
              ],
              [
                  'name' => 'id_siswa',
                  'contents' => $request->idstudent
              ],
              [
                  'name' => 'id_sekolah',
                  'contents' => $idsekolah
              ],
              [
                  'name' => 'surat_keterangan',
                  'contents' => 'surat_keterangan/'.$nm_file
              ],
              [
                  'name' => 'id_kelas',
                  'contents' => $request->classstudent
              ],
              [
                  'name' => 'surat_keterangan',
                  'contents'=>fopen($gambar, 'r'),
                  'filename'  => $nm_file
              ],

          ]
        ]);
      }else{

          $client = new Client();
          $value = session('token');
          $idsekolah     = session()->get('sekolah')['id_sekolah'];
          $res = $client->post(env('API_URL').'/absensimurid',[
          'headers' => [
              'Authorization'     => $value
          ],
              'form_params' => [
                'ijin'              =>  $informationijin,
                'sakit'             =>  $informationsakit,
                'masuk'             =>  $informationmasuk,
                'alfa'              =>  $informationalfa,
                'surat_keterangan'  =>  '',
                'id_sekolah'        =>  $idsekolah,
                'id_kelas'          =>  $request->classstudent,
                'id_siswa'          =>  $request->idstudent
             ]
          ]);
        }

      return 'succes';
    }

    // load data student after absent
    public function loaddatastudent(Request $request)
    {
      $date   = date('Y-m-d');
      $dateIsostart = $date.'T00:00:00.000Z';
      $dateIsoend = $date.'T24:00:00.000Z';

      $token     = session()->get('token');
      $client    = new Client();
      $idsekolah = session()->get('sekolah')['id_sekolah'];
      $get_student = $client->request('GET',env('API_URL').'/siswa?id_sekolah='.$idsekolah.'&id_kelas='.$request->idclass, [
            'headers' => ['Authorization'     => $token ]
         ]);
      $get_absent = $client->request('GET',env('API_URL').'/absensimurid?id_sekolah='.$idsekolah.'&id_kelas='.$request->idclass, [
           'headers' => ['Authorization'     => $token ]
        ]);
      $student = json_decode($get_student->getBody()->getContents());
      $absent = json_decode($get_absent->getBody()->getContents());
      $collect = collect($absent);
      $items = $collect->where('createdAt','>=',$dateIsostart)->where('createdAt','<=',$dateIsoend)->all();
      $data =  array(
        'student' => $student,
        'absent'  => collect($items)
      );
      return view('studentattendance::loaddata',$data);
    }

    // load data absent after procces absent
    public function loaddataabsent(Request $request)
    {
      $date   = date('Y-m-d');
      $dateIsostart = $date.'T00:00:00.000Z';
      $dateIsoend = $date.'T24:00:00.000Z';

      $token     = session()->get('token');
      $client    = new Client();
      $idsekolah = session()->get('sekolah')['id_sekolah'];
      $get_absent = $client->request('GET',env('API_URL').'/absensimurid?id_sekolah='.$idsekolah.'&id_kelas='.$request->idclass, [
            'headers' => ['Authorization'     => $token ]
         ]);
      $absent = json_decode($get_absent->getBody()->getContents());
      $collect = collect($absent);
      $items = $collect->where('createdAt','>=',$dateIsostart)->where('createdAt','<=',$dateIsoend)->all();
      $data =  array(
        'absent'  => $items
      );
      return view('studentattendance::loaddataabsent',$data);
    }
}
