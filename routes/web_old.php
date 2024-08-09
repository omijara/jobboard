<?php

use Illuminate\Support\Facades\Route;
use App\Models\job;
use App\Http\Controllers\JobController;

// Homepage

Route::get('/', function () {

    return view('home');
});

// Job Index

Route::get('/jobs', [JobController::class, 'index']);

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

// Create form

Route::get('/jobs/create', function(){
    return view('jobs.create');

});

// Store

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

// Show

Route::get('/jobs/{id}', function($id) {

   $job = job::find($id);

    return view('jobs.show', ['job' => $job]);
});

Route::get('/jobs/{id}/edit', function($id) {

  $job = job::find($id);

   return view('jobs.edit', ['job' => $job]);
});

//Update

Route::patch('/jobs/{id}', function($id) {

  request(null)->validate([

    'title' => ['required', 'min:3'],
    'salary' => ['required']

  ]);

  $job = Job::findOrFail($id);

  $job->update([
    'title' => request('title'),
    'salary' => request('salary')
  ]);

  return redirect('/jobs/' . $job->id);

});

//Destroy

Route::delete('/jobs/{id}', function($id) {

  // Method 1
  // $job = Job::findOrFail($id);
  // $job->delete();

  // Method 2
  Job::findOrFail($id)->delete();

  return redirect('/jobs');

});

// Contatct Page

Route::get('/contact', function () {
    return view('contact');
});