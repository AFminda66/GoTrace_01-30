<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Session;

use DateTime;
use App\Models\Data_api;
use App\Http\Services\API;
use App\Http\Services\WebServiceReply;

class UserController extends Controller
{
    public function login_chek(Request $request)
    {
        session_start();

        if(!$request->input('email'))
        return redirect('/login')->with('Email requerido');

        if(!is_string($request->input('email')) || !filter_var($request->input('email'), FILTER_VALIDATE_EMAIL))
        return redirect('/login')->with('Email incorrecto');

        if(!$request->input('password'))
        return redirect('/login')->with('message', 'Contraseña requerida');

        $service = new API();
        $result = $service->login([
            "email" => $request->input('email'),
            "password" => $request->input('password'),
            "getToken" => true

        ]); 

        if($result['status'] != 200)
        return redirect('/login')->with('message', $result['message']);

        $result['password'] = $request->input('password');
        $request->session()->put('data', $result);

        return redirect('/datosUsuario');
    }

    public function datosUsuario(Request $request)
    {
        if(!$request->session()->get('data'))
        return redirect('/login');

        $request->session()->put('data', Session::get('data'));
        return view('/datos');
    }

    public function guardarUsuario(Request $request)
    {
        $result = $request->session()->get('data');

        //SE FILTRA EL REGISTRO PARA PODERLO EDITAR
        $reg = Data_api::where('iden_email', $result['identity']['email'])
        ->count();

        if($reg > 0)
        return (new WebServiceReply)->generate('Ya existe el registro');

        $reg = new Data_api;
        $reg->status = $result['status' ];
        $reg->code = $result['code'];
        $reg->message = $result['message'];
        $reg->token = $result['token'];
        $reg->password = $result['password'];
        $reg->iden_iss = $result['identity']['iss'];
        $reg->iden_sub = $result['identity']['sub'];
        $reg->iden_aud = $result['identity']['aud'];
        $reg->iden_typ = $result['identity']['typ'];
        $reg->iden_uuid = $result['identity']['uuid'];
        $reg->iden_name = $result['identity']['name'];
        $reg->iden_surname = $result['identity']['surname'];
        $reg->iden_email = $result['identity']['email'];
        $reg->iden_avatar = $result['identity']['avatar'];

        $date = new DateTime();
        $date->setTimestamp($result['identity']['iat']);
        $reg->iden_iat = $date;

        $date = new DateTime();
        $date->setTimestamp($result['identity']['exp']);
        $reg->iden_exp = $date;

        $reg->save();

        return (new WebServiceReply)->generate([]);
    }

    public function editarUsuario(Request $request)
    {
        $result = $request->session()->get('data');

        //SE FILTRA EL REGISTRO PARA PODERLO EDITAR
        $reg = Data_api::where('iden_email', $result['identity']['email'])->update([
            'iden_name' => $request->input('name'),
            'iden_surname' => $request->input('lastname'),
            'password' => $request->input('password'),
        ]);
        
        if(!$reg)
        return (new WebServiceReply)->generate('No hubo datos que actualizar');

        return (new WebServiceReply)->generate([]);
    }

    public function rutasUsuario(Request $request)
    {
        if(!$request->session()->get('data'))
        return redirect('/login');
        
        $result = $request->session()->get('data');

        $service = new API();
        $result = $service->getRutas(
            [], ['Authentication:'.$result['token']]
        ); 

        if($result['status'] != 200)
        return redirect('/login')->with('message', $result['message']);

        $dias = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'];
        $data = [];

        foreach($result['listaRutas'] as $key => $lista){
            $data[$key] = [
                'id' => $lista['UUID'],
                'nombre' => $lista['Nombre'],
                'tipo' => $lista['TipoRuta'],
                'dias' => []
            ];

            foreach($dias as $dia){
                if(isset($lista[$dia]))
                $data[$key]['dias'][$dia] = $lista[$dia];
            }
        }

        return view('/rutas', ['rutas' => $data]);
    }
}