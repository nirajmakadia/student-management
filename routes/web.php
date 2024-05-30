<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SubjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('students', StudentController::class);
Route::get('students/hard-delete/{id}', [StudentController::class, 'hardDelete'])->name('students.hardDelete');

Route::resource('results', ResultController::class);
Route::resource('subjects', SubjectController::class);

Route::get('/students/{student}/export/{format}', [StudentController::class, 'exportData'])->name('students.export');
Route::get('students/pdf/{id}', [StudentController::class, 'generatePdf'])->name('students.generatePdf');