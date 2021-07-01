<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Response as HttpResponse;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use \Validator, \Auth, \Redirect;
use Request, \Response;
use Carbon\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/donadores';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username(){
        return 'usuario';
    }

    public function doLogin(Request $request){
        try{
            $rules = array(
                'usuario'     => 'required',
                'password' => 'required|min:3'
            );
    
            $validator = Validator::make($request::all(), $rules);
    
            if ($validator->fails()) {
                return response()->json(['validacion'=>false, 'errores'=>$validator->errors()], HttpResponse::HTTP_OK);
            }else{
                $userdata = array(
                    'usuario'     => $request::get('usuario'),
                    'password'  => $request::get('password')
                );
    
                if (Auth::attempt($userdata)) {
                    $usuario = Auth::user();
                    
                    if(Auth::check()){
                        return response()->json(['validacion'=>true, 'datos'=>$usuario], HttpResponse::HTTP_OK);
                    }else{
                        return response()->json(['validacion'=>false, 'datos'=>$usuario], HttpResponse::HTTP_CONFLICT);
                    }
                } else {
                    return response()->json(['validacion'=>false, 'error'=>'Nombre de usuario o contraseña incorrecta'], HttpResponse::HTTP_CONFLICT);
                }
            }
        }catch(\Exception $e){
            return response()->json(['error'=>$e->getMessage(),'line'=>$e->getLine()], HttpResponse::HTTP_CONFLICT);
        }
    }

    public function logout(){
        Auth::logout(); // log the user out of our application
        return Redirect::to('login'); // redirect the user to the login screen
    }
}
