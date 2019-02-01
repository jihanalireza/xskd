<?php

namespace Modules\PembayaranSpp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use GuzzleHttp\Client;
class PembayaranSppController extends Controller
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
        $get_lesson = $client->request('GET',env('API_URL').'/transaksi-spp/', [
              'headers' => ['Authorization' => $token ]
            ]);
        $lesson = json_decode($get_lesson->getBody()->getContents());
        $data_tr_spp = collect($lesson)->whereIn('id_sekolah',$idschool);
        return view('pembayaranspp::index',compact('data_tr_spp'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('pembayaranspp::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('pembayaranspp::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('pembayaranspp::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
    public function terima($id){
        $token     = session()->get('token');
        $idschool = session()->get('sekolah')['id_sekolah'];
        $client    = new Client();
        $get_lesson = $client->request('PATCH',env('API_URL').'/transaksi-spp/', [
              'headers' => ['Authorization' => $token ],
              'form_params' => [
                'status' => '2'
              ]
            ]);
            if ($get_lesson) {
                return redirect('pembayaranspp')->with(['response' => 'success', 'message' => 'Status Berhasil Di rubah']);
            } else {
                return redirect('pembayaranspp')->with(['response' => 'error', 'message' => 'Status Gagal Di rubah']);
            }

    }
    public function tolak($id){
        $token     = session()->get('token');
        $idschool = session()->get('sekolah')['id_sekolah'];
        $client    = new Client();
        $get_lesson = $client->request('PATCH',env('API_URL').'/transaksi-spp/', [
              'headers' => ['Authorization' => $token ],
              'form_params' => [
                'status' => '3'
              ]
            ]);
            if ($get_lesson) {
                return redirect('pembayaranspp')->with(['response' => 'success', 'message' => 'Status Berhasil Di rubah']);
            } else {
                return redirect('pembayaranspp')->with(['response' => 'error', 'message' => 'Status Gagal Di rubah']);
            }

    }
}
