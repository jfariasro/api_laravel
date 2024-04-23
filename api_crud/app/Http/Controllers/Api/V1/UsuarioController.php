<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\Persona;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = Usuario::all();
        return response()->json($usuario);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Obtener los datos de la persona
        $persona = Persona::findOrFail($request->idpersona);

        // Generar el correo
        $mail = $this->generateMail($persona->nombres, $persona->apellidos);

        $mail = $this->adjustMailIfDuplicate($mail);

        // Crear el nuevo usuario
        $usuario = new Usuario;
        $usuario->idpersona = $request->idpersona;
        $usuario->username = $request->username;
        $usuario->password = $request->password;
        $usuario->mail = $mail;
        $usuario->sesionactiva = $request->sesionactiva;
        $usuario->estado = $request->estado;
        $usuario->save();

        return response()->json([
            "message" => "Registro Agregado Correctamente !"
        ]);
    }

    private function generateMail($nombres, $apellidos)
    {
        // Generar el correo en base a los nombres y apellidos
        $mail = strtolower(substr($nombres, 0, 1) . $apellidos . "@mail.com");

        return $mail;
    }

    private function adjustMailIfDuplicate($mail)
    {
        $counter = 1;
        $originalMail = $mail;
        $parts = explode('@', $mail);
        $username = $parts[0];
        $domain = $parts[1];

        // Verificar si el correo ya existe y ajustar si es necesario
        while (Usuario::where('mail', $mail)->exists()) {
            $mail = $username . $counter++ . '@' . $domain;
        }

        return $mail;
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $usuario = Usuario::find($id);

        if (!empty($usuario)) {
            return response()->json($usuario);
        } else {
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
        // Obtener los datos de la persona
        $persona = Persona::findOrFail($request->idpersona);

        // Generar el correo
        $mail = $this->generateMail($persona->nombres, $persona->apellidos);

        $mail = $this->adjustMailIfDuplicate($mail);

        $usuario = Usuario::find($id);

        $usuario->idpersona = $request->idpersona;
        $usuario->username = $request->username;
        $usuario->password = $request->password;
        $usuario->mail = $mail;
        $usuario->sesionactiva = $request->sesionactiva;
        $usuario->estado = $request->estado;
        $usuario->save();

        return response()->json([
            "message" => "Registro Actualizado Correctamente !"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $usuario = Usuario::find($id);
        $usuario->delete();

        return response()->json([
            "message" => "Registro Eliminado Correctamente !"
        ]);
    }
}
