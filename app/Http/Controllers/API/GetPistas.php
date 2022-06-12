<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Registros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GetPistas extends Controller
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


    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pista  $pista
     * @return \Illuminate\Http\Response
     */
    public function show($pista)
    {
        $pista = DB::table('registros')
        ->where('pista', $pista)
        ->get();

        return ['pista' => $pista];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pista  $pista
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registros $pista)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pista  $pista
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registros $pista)
    {
        //
    }
}
