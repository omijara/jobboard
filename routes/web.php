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
    // $jobs = Job::with('employer')->paginate(3);
    // $jobs = Job::with('employer')->cursorPaginate(3);
    $jobs = Job::with('employer')->latest()->simplePaginate(4);
    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

Route::get('/jobs/create', function(){
    return view('jobs.create');

});

Route::post('/jobs', function(){

  // dd(request()->all());
  // dd(request('title'));

  request(null)->validate([

    'title' => ['required', 'min:3'],
    'salary' => ['required']

  ]);

  Job::create([
    'title' => request('title'),
    'salary' => request('salary'),
    'employer_id' => 1
  ]);

  return redirect('/jobs');

});    

Route::get('/jobs/{id}', function($id) {

   $job = job::find($id);

//    dd($job);

    return view('jobs.show', ['job' => $job]);
});

Route::get('/contact', function () {
    return view('contact');
});