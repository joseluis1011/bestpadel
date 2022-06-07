<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Registros;
class GetRegistros extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        return response()->json(['usuario' => $user, 'registros' => $user->registros,]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pista' => 'required|max:6',
            'dia' => 'required',
            'mes' => 'required|max:12',
            'hora' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
            ]);
        } else {
            $pista = Registros::create([
                'pista' => $request->pista,
                'dia' => $request->dia,
                'mes' => $request->mes,
                'hora' => $request->hora,
                'user_id'=> Auth::id(),
            ]);

            return response()->json([
                'status'=> 200,
                'message'=> 'Reserva de la pista '.$pista->pista.' a las '.$pista->hora.' del día '.$pista->dia.' realizada correctamente',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($dia, $pista)
    {
        $pista = DB::table('registros')
        ->where('pista', $pista)
        ->where('dia',$dia)
        ->get();

        return ['pista' => $pista];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
