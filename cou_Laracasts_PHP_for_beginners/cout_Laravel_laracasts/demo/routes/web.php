<?php

use Illuminate\Support\Facades\Route;

class Job{
    public static function all():array
    {
        return [
            [
                'id' => 1,
                'title' => 'Software Engineer',
                'salary' => '$80,000'
            ],
            [
                'id' => 2,
                'title' => 'Data Scientist',
                'salary' => '$90,000'
            ],
            [
                'id' => 3,
                'title' => 'Web Developer',
                'salary' => '$70,000'
            ]
        ];
    }
}


Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function ()  {
    return view('jobs', [
        'jobs' => Job::all()
    ]);
});
Route::get('/jobs/{id}', function($id) {
        $job = \Illuminate\Support\Arr::first(Job::all(), fn($job) => $job['id'] == $id);
        
        return view('job', [
            'job' => $job
        ]);
});
Route::get('/contact', function () {
    return view('contact');
});