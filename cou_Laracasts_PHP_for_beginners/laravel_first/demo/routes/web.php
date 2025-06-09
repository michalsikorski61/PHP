<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Arr;
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

Route::get('/jobs', function(){
    return view('jobs',[
        'jobs' => [
            [
                'id' => 1,
                'title' => 'Director',
                'salary' => '$50,000',
            ],
            [
                'id' => 2,
                'title' => 'Programmer',
                'salary' => '$40,000',
            ],
            [
                'id' => 3,
                'title' => 'Teacher',
                'salary' => '$30,000',
            ]
        ],
    ]);
});

Route::get('/job/{id}', function($id){
    $jobs = [
            [
                'id' => 1,
                'title' => 'Director',
                'salary' => '$50,000',
            ],
            [
                'id' => 2,
                'title' => 'Programmer',
                'salary' => '$40,000',
            ],
            [
                'id' => 3,
                'title' => 'Teacher',
                'salary' => '$30,000',
            ]
        ];
    $job = Arr::first($jobs, fn($job) => $job['id'] == $id);
    return view('job', [
        'job' => $job
    ]);
});

Route::get('/contact', function(){
    return view('contact');
});