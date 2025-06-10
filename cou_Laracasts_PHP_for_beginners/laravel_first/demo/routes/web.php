<?php


use Illuminate\Support\Facades\Route;
use App\Models\Job;
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

Route::get('/jobs', function() {
    return view('jobs',[
        'jobs' => Job::all()
    ]);
});

Route::get('/job/{id}', function($id){
    $job = Job::find($id);
    return view('job', [
        'job' => $job
    ]);
});

Route::get('/contact', function(){
    return view('contact');
});