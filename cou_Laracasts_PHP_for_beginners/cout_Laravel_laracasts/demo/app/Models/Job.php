<?php

namespace App\Models;

use \Illuminate\Support\Arr;

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

    public static function find(int $id):array
    {
        $job = Arr::first(static::all(), fn($job) => $job['id'] == $id);
        if(!$job){
            abort(404);
        }
    }
}