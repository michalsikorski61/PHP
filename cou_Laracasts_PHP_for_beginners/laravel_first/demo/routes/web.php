<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', HomeController::class);

// Route::get('/about', function (){
//     // return ['json' => 'from Laravel'];
//     return view('page/about', [
//         'greeting' => 'Welcome to the about page',
//     ]);
// });
Route::get('/', function(){
    return view('home');
});
Route::get('/we',function(){
    return view('we', [
        'we' => 'We are Venom',
    ]);
});

Route::get('/about', function(){
    return view('about');
});

Route::get('/contact', function(){
    return view('contact');
});