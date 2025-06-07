<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);

// Route::get('/about', function (){
//     // return ['json' => 'from Laravel'];
//     return view('page/about', [
//         'greeting' => 'Welcome to the about page',
//     ]);
// });