<?php

namespace Modules\Authentication\Http\Controllers;
use GuzzleHttp\Pool;
use GuzzleHttp\Event\ErrorEvent;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $uri = $request->segment(2);
        if($uri != 'login'){
            $client = new Client();
            $send = $client->get(env('API_URL').'/role');
            $data = $send->getBody()->getContents();
            $token = json_decode($data);
            return view('authentication::register',['level' => $token]);
        }else{
           return view('authentication::login');
       }
   }

/**
* Show the form for creating a new resource.
* @return Response
*/
public function create()
{
    return view('authentication::create');
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
    return view('authentication::show');
}

/**
* Show the form for editing the specified resource.
* @return Response
*/
public function edit()
{
    return view('authentication::edit');
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

public function register(request $request){

    $validateRegister = $request->validate([
        'email' => 'required',
        'password' => 'required|min:6',
        'nama_sekolah' => 'required',
        'level' => 'required'
    ]);

    try{
        $client = new Client;
        $register = $client->request('POST',env('API_URL').'/users', [
            'form_params' => [
                'email' => $request->email,
                'password' => $request->password,
                'id_sekolah' => $request->nama_sekolah,
                'id_role' => $request->level,
                'id_siswa' => $request->nama_siswa,
                'id_guru' => $request->nama_guru
            ]
        ]);
    }catch (\Exception $e){
        $e = json_decode($e->getResponse()->getBody());
        if($e->code == 400){
            $error = ValidationException::withMessages([
                'email' => ['* Email has been taken, '.$e->errors[0]->message],
            ]);
        }
        throw $error;
    }

    return redirect()->route('login.form');
}

public function login(Request $request)
{
    $validateLogin = $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);

    try{
        $client = new Client();
        $send = $client->post(env('API_URL').'/authentication',[
            'form_params' => [
                'strategy' => 'local',
                'email' => $request->email,
                'password' => $request->password,
            ]
        ]);
        $data = $send->getBody()->getContents();
        $token = json_decode($data);

        $request->session()->put('token', $token->accessToken);
        $this->putsessionauth($request->email);


    }catch (\Exception $e){
        $e = json_decode($e->getResponse()->getBody());
        if($e->code == 401){
            $error = ValidationException::withMessages([
                'email' => ['* Unregistered email'],
            ]);
        }
        throw $error;
    }
    return redirect('/');
}

public function putsessionauth($email)
{
    $client = new Client();
    $token = session()->get('token');
    $getdatauser = $client->request('GET',env('API_URL').'/users?email='.$email,[
        'headers' => [
            'Authorization' => $token
        ],
    ]);

    $dataUser = json_decode($getdatauser->getBody()->getContents());

    $dataSekolah = array(
        'id_sekolah' => $dataUser[0]->sekolah->id_sekolah,
        'nama_sekolah' => $dataUser[0]->sekolah->nama_sekolah,
        'nomor_tlp' => $dataUser[0]->sekolah->nomor_tlp,
        'logo' => $dataUser[0]->sekolah->logo,
    );

    $dataRole = array(
        'id_role' => $dataUser[0]->role->id_role,
        'level' => $dataUser[0]->role->level
    );

    if ($dataUser[0]->role->id_role == 5) {
        $dataSekolah["foto_guru"] = $dataUser[0]->guru->foto;
        $dataSekolah["nama_guru"] = $dataUser[0]->guru->nama_guru;
        $dataSekolah["id_guru"] = $dataUser[0]->guru->id_guru;
        $dataSekolah["alamat"] = $dataUser[0]->guru->alamat;
        $dataSekolah["email"] = $dataUser[0]->guru->email;
    }
   
    $putsessionsekolah  = session()->put('sekolah',$dataSekolah);
    $putsessionrole     = session()->put('role',$dataRole);

    return $dataUser;

}

public function logout()
{
    session()->flush();
    return redirect()->route('login.form');
}
}
