<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use DB;

use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Muestra la lista de usuario.
     */
    public function index()
    {
        $users = User::OrderBy('created_at', 'desc')->get();

        if( Crypt::decryptString( session( env( "APP_CODE" ) . 'r013' ) ) == 2 ){

            $users = User::Where( "role_id", 3 )->OrderBy('created_at', 'desc')->get();
        }
        
        return view('user.index', compact('users'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        $roles = Role::OrderBy('created_at', 'desc')->get();

        if( Crypt::decryptString( session( env( "APP_CODE" ) . 'r013' ) ) == 2 ){

            $roles = Role::Where('id',3)->OrderBy('created_at', 'desc')->get();
        }
        return view('user.create', compact('roles'));
    }

    /**
     * Muestra el formulario de edición para un usuario existente.
     */
    public function edit($id)
    {
        $roles = Role::OrderBy('created_at', 'desc')->get();
        if( Crypt::decryptString( session( env( "APP_CODE" ) . 'r013' ) ) == 2 ){

            $roles = Role::Where('id',3)->OrderBy('created_at', 'desc')->get();
        }
        $user = User::findOrFail($id);
        return view('user.edit', compact('roles', 'user'));
    }

    /**
     * Guardar un nuevo usuario con carga de imágenes.
     */
    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'role_id' => 'required|exists:roles,id',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|min:6',
            'repassword' => 'required|string|min:6|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();
        try {
            // Guardar usuario
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role_id = $request->role_id;
            $user->password = Hash::make( $request->password );
            $user->save();

            DB::commit();
            return response()->json(['success' => true, 'message' => 'usuario guardado correctamente.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Actualiza un usuario existente con carga de imágenes.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if( !$user ){
            return response()->json(['errors' => ['No existe el usuario']], 422);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'role_id' => 'required|exists:roles,id',
            'email' => 'required|string|unique:users,email,' . $user->id,
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();
        try {

            $user->name = $request->name;
            $user->role_id = $request->role_id;
            $user->email = $request->email;            
            $user->save();
            
            DB::commit();
            return response()->json(['success' => true, 'message' => 'usuario actualizado correctamente.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Eliminar un usuario (SoftDelete).
     */
    public function delete(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->delete();
        return response()->json(['success' => true, 'message' => 'usuario eliminada correctamente.']);
    }
}