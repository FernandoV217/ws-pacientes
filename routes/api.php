<?php

use App\Http\Controllers\PacienteController;
use Illuminate\Support\Facades\Route;

Route::get('/pacientes', [PacienteController::class, 'obtenerPacientes']);

Route::post('/pacientes', [PacienteController::class, 'guardarPaciente']);

Route::put('/pacientes/{id}', [PacienteController::class, 'editarPaciente']);

Route::delete('/pacientes/{id}', [PacienteController::class, 'eliminarPaciente']);
