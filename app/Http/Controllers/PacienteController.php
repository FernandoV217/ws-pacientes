<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PacienteController extends Controller
{
    public function obtenerPacientes() {        
        $pacientes = Paciente::all();

        if ($pacientes->isEmpty()) {
            $data = [
                'message' => 'Lista vacía',
                'status' => 200
            ];

            return response()->json($data, $data['status']);
        }
        
        $data = [
            'result' => $pacientes,
            'status' => 200
        ];

        return response()->json($data, $data['status']);        
    }

    public function guardarPaciente(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'caretaker' => 'required',
            'email' => 'required',
            'date' => 'required',
            'symptoms' => 'required',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, $data['status']);
        }

        $paciente = Paciente::create([
            'name' => $request->name,
            'caretaker' => $request->caretaker,
            'email' => $request->email,
            'date' => $request->date,
            'symptoms' => $request->symptoms,
        ]);

        if (!$paciente) {
            $data = [
                'message' => 'Error al crear el paciente',
                'status' => 500
            ];

            return response()->json($data, $data['status']);
        }

        $data = [
            'message' => 'Paciente Guardado Correctamente',
            'status' => 201
        ];

        return response()->json($data, $data['status']);
    }
    
    public function editarPaciente(Request $request, $id) {

        $paciente = Paciente::find($id);

        if (!$paciente) {
            $data = [
                'message' => 'Paciente no encontrado',
                'status' => 404
            ];

            return response()->json($data, $data['id']);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'caretaker' => 'required',
            'email' => 'required',
            'date' => 'required',
            'symptoms' => 'required',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, $data['status']);
        }


        $paciente->name = $request->name;
        $paciente->caretaker = $request->caretaker;
        $paciente->email = $request->email;
        $paciente->date = $request->date;
        $paciente->symptoms = $request->symptoms;

        // if (!$paciente) {
        //     $data = [
        //         'message' => 'Error al crear el paciente',
        //         'status' => 500
        //     ];

        //     return response()->json($data, $data['status']);
        // }

        $paciente->save();

        $data = [
            'message' => 'Paciente Editado Correctamente',
            'status' => 201
        ];

        return response()->json($data, $data['status']);
    }

    public function eliminarPaciente($id) {
        $paciente = Paciente::find($id);

        if(!$paciente) {
            $data = [
                'message' => 'Paciente no encontrado',
                'status' => 404
            ];

            return response()->json($data, $data['status']);
        }

        $paciente->delete();

        $data = [
            'message' => 'Paciente Eliminado Correctamente',
            'status' => 200
        ];

        return response()->json($data, $data['status']);
    }
}
