<?php

use Illuminate\Support\Facades\Route;
use App\Models\job;

Route::get('/', function () {

    return view('home');
});

Route::get('/jobs', function () {
    // return view('jobs', ['jobs' => job::all()]);

    // using Eager loading
    // $jobs = Job::with('employer')->get();
    // $jobs = Job::with('employer')->simplePaginate(3);
    // $jobs = Job::with('employer')->cursorPaginate(3);
       $jobs = Job::with('employer')->paginate(3);
    return view('jobs', [
        'jobs' => $jobs
    ]);
});


Route::get('/jobs/{id}', function($id) {

   $job = job::find($id);
   

//    dd($job);

    return view('job', ['job' => $job]);
});


Route::get('/contact', function () {
    return view('contact');
});