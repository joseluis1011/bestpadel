<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Registros;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            'email' => 'required|email|max:191|unique:users,email',
            'password' => 'required|min:8',
            'telefono' => 'required|min:9|max:9'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
            ]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'telefono' => $request->telefono,
                'password' => Hash::make($request->password),
            ]);

            $token = $user->createToken($user->email . '_token')->plainTextToken;

            return response()->json([
                'status'=> 200,
                'username'=> $user->name,
                'token'=> $token,
                'admind' => $user->admind,
                'message'=> 'Registrado correctamente',
            ]);


        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:191',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
            ]);
        } else {
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status'=>401,
                    'message'=>'Invalid Credentials',
                ]);
            } else {
                $token = $user->createToken($user->email . '_token')->plainTextToken;
                return response()->json([
                    'status' => 200,
                    'username' => $user->name,
                    'token' => $token,
                    'admind' => $user->admind,
                    'message' => 'Login realizado correctamente',
                ]);
            }
        }
    }
    
    public function editarperfil(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'max:191',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
            ]);
        } else {
            $user = request()->user();
            if ($request->name!=null) {
                $user->name = $request->name;
            }
            if ($request->password!=null) {
                $user->password = Hash::make($request->password);
            }
            if ($request->telefono!=null) {
                $user->telefono = $request->telefono;
            }
            if ($request->lado!=null) {
                $user->lado = $request->lado;
            }
            $user->save();
                
            return response()->json([
                'status'=> 200,
                'message'=> 'Edit realizado correctamente',
            ]);
        }
    }

    public function logout(){

        $user = request()->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Logout realizado correctamente',
        ]);
    }
}
