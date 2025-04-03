<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

use Carbon\Carbon;
use Validator;

use App\Models\User;


class AuthController extends Controller
{

    public function logout( Request $request ){

        $request->session()->flush();

        return redirect()->to( '/' );
    }

    #Función de validar login
    public function validateLogin( Request $request ){
        $messages = [
            'email.required' => 'El Correo electrónico es obligatorio',
            'email.email' => 'El Correo debe ser un email',
            'password.required' => 'La Contraseña es obligatoria',
        ];
        $validate = Validator::make( $request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], $messages );

        if( $validate->fails() ){

            $errors = $validate->errors()->all();
            return redirect()->route( 'login' )
            ->withInput()
            ->withErrors( $errors );
        }
        else{
            try {
                
                if(!Auth::attempt($request->only(['email', 'password']))){

                    $validate->errors()->add( 'Ocurrio un error', "Crendenciales invalidas, intente nuevamente." );
                    $errors = $validate->errors()->all();

                    return redirect()->route( 'login' )
                    ->withInput()
                    ->withErrors( $errors );
                }

                $user = User::where('email', $request->email)->first();

                $request->session()->put([
                    env( "APP_CODE" ) . '3m41l' => $user->email,
                    env( "APP_CODE" ) . '1d' => Crypt::encryptString( $user->id ),
                    env( "APP_CODE" ) . 'n4m3' => $user->name,
                    env( "APP_CODE" ) . 'r013' => Crypt::encryptString( $user->role_id )
                ]);
                return redirect()->route( 'campaign.list' );
            } catch (\Throwable $th) {

                return redirect()->route('login')
                ->withInput()
                ->withErrors( $th->getMessage() );
            }
        }
    }
}