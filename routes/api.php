<?php

use App\Http\Controllers\EmpresaController;
use Illuminate\Support\Facades\Route;

Route::post('/empresa/cadastrar', [EmpresaController::class, 'cadastrarEmpresa']);