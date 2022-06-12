<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\userTorneo as usuarioTorneo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\userTorneoResource;

class userTorneo extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     
     public function userTorneo() {

        $user = Auth::user();
        $TorneoArray = array();
        foreach ($user->userTorneo as $userTorneo) {
              $Torneo = DB::table('torneos')
                ->where('id', $userTorneo['torneo_id'])
                ->get();  
                array_push($TorneoArray, $Torneo);
        }
        return response()->json(['usuario' => $user, 'Torneo' => $TorneoArray ]);
    }
    public function store(Request $request)
    {


        $userTorneo = usuarioTorneo::create([
            'user_id' => Auth::id(),
            'torneo_id' => $request->torneo_id,
        ]);

        return response()->json([
            'status'=> 200,
            'message'=> 'Usted se ha apuntado al torneo',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
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
        $userTorneo = DB::table('user_torneos')
                ->where('user_id', Auth::user()->id)
                ->where('torneo_id', $request->torneo_id)
                ->get();
                
        $user = usuarioTorneo::findOrFail($userTorneo[0]->id);

        $user->delete();
        
        return response()->json([
            'status'=> 200,
            'message'=> 'Reserva borrada correctamente',
        ]);

    }
}
