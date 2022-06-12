<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Torneo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\userTorneo;

class Torneos extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = Torneo::all();
        return response()->json($table);
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
            'title' => 'required|min:8|max:50',
            'description' => 'required|max:300',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
            ]);
        } else {
            $Torneo = Torneo::create([
                'title' => $request->title,
                'description' => $request->description,
                'dia' => $request->dia,
                'mes' => $request->mes,
            ]);

            return response()->json([
                'status'=> 200,
                'message'=> 'Torneo creado correctamente',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy(Request $request)
    {
        $torneo = Torneo::findOrFail($request->id);
        $torneo->delete();
        $userTorneo = DB::table('user_torneos')
                ->where('torneo_id', $request->id)
                ->get();  
        foreach ($userTorneo as $userTorneo) {
                $registro = userTorneo::findOrFail($userTorneo->id);
                $registro->delete();
        }
        return response()->json([
            'status'=> 200,
            'message'=> 'Reserva borrada correctamente',
        ]);
    }
}
