<?php

namespace Modules\Forgotpassword\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ForgotpasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('forgotpassword::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('forgotpassword::create');
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
        return view('forgotpassword::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('forgotpassword::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $client = new Client();
        $reset = $client->request('PATCH', env('API_URL') . '/users?email=' . $request->email, [
             'form_params' => [
                'password' => $request->password
            ]
        ]);
        return redirect('authentication/login')->with('resetSuccess', 'berhasil');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function sendmail(Request $request)
    {
      $validateUpdate = $request->validate([
          'email' => 'required',
      ]);

      $client = new Client();
      $getdatauser = $client->request('GET',env('API_URL').'/users?email='.$request->email);
      $dataUser = json_decode($getdatauser->getBody()->getContents());

      if ($dataUser != null) {
        $email = $dataUser[0]->email;
        $name = $email;
        Mail::to($request->email)->send(new SendMailable($name));

        return redirect('authentication/login')->with('sendSuccess','berhasil');

      }else {
        return redirect('forgotpassword')->with('failed', 'gagal');
      }
    }

    public function verify($token)
    {
      $email = decrypt($token);
      return view('forgotpassword::resetpassword',['email'=>$email]);
    }
}
