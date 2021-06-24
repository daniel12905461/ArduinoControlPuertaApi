<?php

namespace App\Http\Controllers;

use App\Models\historial;
use App\Models\User;
use Illuminate\Http\Request;

class HistorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $historial = historial::with('user')->orderBy('updated_at','desc')->get();

        return response()->json($historial, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user = User::where('RFID', $request->input('RFID'))->first();

        if ($user) {
            $historial = historial::where('fechaHoraEntrada', null)->where('user_id',$user->id)->first();
            if($historial){
                // $historial->fechaHoraSalida = date('Y-m-d H:i:s');
                $historial->fechaHoraEntrada = date('Y-m-d H:i:s');
                $historial->user_id = $user->id;
                $historial->enabled = '1';
                $historial->save();
            }else{
                $historial = new historial();
                $historial->fechaHoraSalida = date('Y-m-d H:i:s');
                // $historial->fechaHoraEntrada = '';
                $historial->user_id = $user->id;
                $historial->enabled = '1';
                $historial->save();
            }

            return response()->json([
                'status' => 'success',
                $historial,
                200
            ]);
        }else {
            return response()->json('RFID incorrectos', 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\historial  $historial
     * @return \Illuminate\Http\Response
     */
    public function show(historial $historial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\historial  $historial
     * @return \Illuminate\Http\Response
     */
    public function edit(historial $historial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\historial  $historial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, historial $historial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\historial  $historial
     * @return \Illuminate\Http\Response
     */
    public function destroy(historial $historial)
    {
        //
    }
}
