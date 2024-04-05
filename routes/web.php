<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FunctionController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [FunctionController::class, 'questionPage']);
Route::get('/process', [FunctionController::class, 'proceesQuestion']);