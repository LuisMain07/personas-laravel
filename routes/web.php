<?php

use App\Http\Controllers\ComunaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/comunas', [ComunaController::class, 'index']);