<?php

namespace App\Http\Controllers;

use App\Mail\PhEmail;
use App\Models\LecturaPiscina;
use App\Models\Piscina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LecturaPiscinaController extends Controller
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
        $request_data = $request->only('codigo_piscina', 'lectura');

        $validate_request = Validator::make($request_data, [
            'codigo_piscina' => 'required|uuid|exists:App\Models\Piscina,uuid',
            'lectura' => 'required|numeric'
        ]);

        if ($validate_request->fails()) {
            return response()->json(array(
                'status' => 'bad_request',
                'mensajes' => 'Los campos de la peticion son invalidos.',
                'errores' => $validate_request->errors()
            ), 400);
        }

        $data = $validate_request->validate();

        $lectura = LecturaPiscina::create([
            'lectura' => $data["lectura"],
            'piscina_id' => Piscina::where("uuid", $data["codigo_piscina"])->first()->id
        ]);

        // $correo = new PhEmail;
        // Mail::to("sdiazarrieta@gmail.com")->send($correo);

        return response()->json(array(
            'status' => 'success',
            'mensajes' => "bien",
            'lectura' => $lectura
        ), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LecturaPiscina  $lecturaPiscina
     * @return \Illuminate\Http\Response
     */
    public function show(LecturaPiscina $lecturaPiscina)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LecturaPiscina  $lecturaPiscina
     * @return \Illuminate\Http\Response
     */
    public function edit(LecturaPiscina $lecturaPiscina)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LecturaPiscina  $lecturaPiscina
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LecturaPiscina $lecturaPiscina)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LecturaPiscina  $lecturaPiscina
     * @return \Illuminate\Http\Response
     */
    public function destroy(LecturaPiscina $lecturaPiscina)
    {
        //
    }
}
