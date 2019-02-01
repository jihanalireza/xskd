<?php

namespace Modules\BorrowBook\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use QrCode;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendInvoice;
class BorrowBookController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
      $token     = session()->get('token');
      $client    = new Client();
      $get_borrow = $client->request('GET',env('API_URL').'/peminjam-buku', [
        'headers' => ['Authorization' => $token ]
      ]);
      $borrow_data = json_decode($get_borrow->getBody()->getContents());
      // dd($borrow_data);
      return view('borrowbook::index',compact('borrow_data'));
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
      return view('borrowbook::create',$data);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
      $explodejangka = explode(" - ", $request->jangka_peminjaman);

      $request->validate([
        'nama_buku' => 'required',
        'siswa' => 'required',
        'jangka_peminjaman' => 'required',
      ]);

      $kode_peminjaman = 'QR'.rand().date('his');
      $nm_file = $kode_peminjaman.'.png';
      $client = new Client();
      $token = session('token');

        // Generate Barcode
      $createdirectory = Storage::makeDirectory('public/barcode');
      Storage::put('public/barcode'.'/'.$nm_file, QrCode::format('png')->margin(0)->size(250)->generate($kode_peminjaman));
      $file = Storage::get('public/barcode/'.$nm_file);

      $res = $client->post(env('API_URL').'/peminjam-buku',[
        'headers' => [
          'Authorization'     => $token
        ],
        'multipart' => [
         [
          'name' => 'kd_peminjam',
          'contents' => $kode_peminjaman
        ],
        [
          'name' => 'tgl_pinjam',
          'contents' => $explodejangka[0]
        ],
        [
          'name' => 'tgl_pengembalian',
          'contents' => $explodejangka[1]
        ],
        [
          'name' => 'status',
          'contents' => 'dipinjam'
        ],
        [
          'name' => 'id_buku',
          'contents' => $request->nama_buku
        ],
        [
          'name' => 'id_sekolah',
          'contents' => session()->get('sekolah')['id_sekolah']
        ],
        [
          'name' => 'id_siswa',
          'contents' => $request->siswa
        ],
        [
          'name' => 'qr_code',
          'contents' => 'qr_code/'.$nm_file
        ],
        [
          'name' => 'qr_code',
          'contents'=>fopen('storage/barcode/'.$nm_file, 'r'),
          'filename'  => $nm_file
        ],
      ]
    ]);
      Storage::delete('public/barcode'.'/'.$nm_file);
      return redirect()->route('borrowbookIndex')->with(['response' => 'success', 'message' => 'Data Peminjaman Berhasil Ditambah']);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
      return view('borrowbook::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
      $token = session()->get('token');
     $client = new Client();
     $get_borrow = $client->request('GET',env('API_URL').'/peminjam-buku/'.$request->id_pinjam_buku,[
       'headers' => [
         'Authorization' => $token,
       ],
     ]);
     $get_bookdata = $client->request('GET',env('API_URL').'/buku/'.$request->id_buku,[
       'headers' => [
         'Authorization' => $token,
       ],
     ]);
     $get_studentdata = $client->request('GET',env('API_URL').'/siswa/'.$request->id_siswa,[
       'headers' => [
         'Authorization' => $token,
       ],
     ]);
     $get_data_school = $client->request('GET',env('API_URL').'/sekolah/'.session()->get('sekolah')['id_sekolah'],[
         'headers' => [
           'Authorization' => $token,
         ]
     ]);
     $databorrow = json_decode($get_borrow->getBody()->getContents());
     $dataSekolah = json_decode($get_data_school->getBody()->getContents());
     $bookdata = json_decode($get_bookdata->getBody()->getContents());
     $studentdata = json_decode($get_studentdata->getBody()->getContents());
       return view('borrowbook::edit',compact('dataSekolah','bookdata','studentdata','databorrow'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $explodejangka = explode(" - ", $request->jangka_peminjaman);
        $token = session()->get('token');
        $client = new Client();
        $update_Classdata = $client->request('PATCH',env('API_URL').'/peminjam-buku/'.$request->id_pinjam_buku,[
          'headers' => [
            'Authorization' => $token,
          ],
          'form_params' => [
            'id_buku' => $request->id_buku,
            'id_siswa' => $request->id_siswa,
            'tgl_pinjam' => $explodejangka[0],
            'tgl_pengembalian' => $explodejangka[1],
          ],
        ])->getBody();
        return redirect('/borrowbook');
    }

    public function sendInvoice(Request $request)
    {
      $client = new Client();
      $getdatauser = $client->request('GET', env('API_URL') . '/users?id_siswa='.$request->siswa);
      $getpinjambuku =  $client->request('GET', env('API_URL') . '/peminjam-buku/?status=telat&id_siswa='.$request->siswa);
      $dataUser = json_decode($getdatauser->getBody()->getContents());
      $datapinjam = json_decode($getpinjambuku->getBody()->getContents());

      if ($dataUser != null ) {
        $email = $dataUser[0]->email;
        $name = $email;
        Mail::to($name)->send(new SendInvoice($name,$datapinjam));
        return redirect()->route('borrowbookIndex')->with(['response' => 'success', 'message' => 'Peringatan Berhasil Dikirim']);
      } else {
        return redirect()->route('borrowbookIndex')->with(['response' => 'error', 'message' => 'Peringatan Gagal Dikirim']);
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
      $client->request('DELETE', env('API_URL') . '/peminjam-buku/' . $id, [
        'headers' => [
          'Authorization' => $get_token
        ]
      ]);
      if ($client) {
        return redirect('/borrowbook')->with(['response' => 'success', 'message' => 'Data Peminjam Buku Berhasil Dihapus']);
      } else {
        return redirect('/borrowbook')->with(['response' => 'error', 'message' => 'Data Peminjam Buku Gagal Dihapus']);
      }
    }

    public function getbook()
    {
      $token     = session()->get('token');
      $idsekolah     = session()->get('sekolah')['id_sekolah'];
      $client    = new Client();
      $get_data_class = $client->request('GET',env('API_URL').'/buku', [
       'headers' => ['Authorization'     => $token ]
     ]);
      $class = json_decode($get_data_class->getBody()->getContents());
      return collect($class)->whereIn('id_sekolah',$idsekolah);
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
    public function databorrowbook()
    {
      $token     = session()->get('token');
      $idsekolah     = session()->get('sekolah')['id_sekolah'];
      $client    = new Client();
      $get_data_student = $client->request('GET',env('API_URL').'/peminjam-buku?id_sekolah='.$idsekolah, [
       'headers' => ['Authorization'     => $token ]
     ]);
      $class = json_decode($get_data_student->getBody()->getContents());
      return collect($class)->whereIn('id_sekolah',$idsekolah);
    }

  }
