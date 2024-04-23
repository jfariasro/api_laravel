<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $persona = Persona::all();
        return response()->json($persona);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $persona = new Persona;
        $persona->nombres = $request->nombres;
        $persona->apellidos = $request->apellidos;
        $persona->identificacion = $request->identificacion;
        $persona->fechanacimiento = $request->fechanacimiento;
        $persona->save();

        return response()->json([
            "message" => "Registro Agregado Correctamente !"
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $persona = Persona::find($id);

        if(!empty($persona)) {
            return response()->json($persona);
        }
        else {
            return response()->json([
                "message" => "El Registro no se encuentra."
            ]);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $persona = Persona::find($id);

        $persona->nombre = $request->nombre;
        $persona->nombres = $request->nombres;
        $persona->apellidos = $request->apellidos;
        $persona->identificacion = $request->identificacion;
        $persona->fechanacimiento = $request->fechanacimiento;
        $persona->save();

        return response()->json([
            "message" => "Registro Actualizado Correctamente !"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $persona = Persona::find($id);
        $persona->delete();

        return response()->json([
            "message" => "Registro Eliminado Correctamente !"
        ]);
    }
}
