<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Task\{
    Index as TaskIndex,
};

use App\Livewire\Dashboard\{
    Index as DashboardIndex,
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::group(['prefix' => 'task', 'as' => 'task.'], function(){
//     Route::get('/', TaskIndex::class)->name('index');
// });

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function(){
        Route::get('/dashboard', DashboardIndex::class)->name('dashboard.1');
    });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/task', function () {
        return view('task');
    })->name('task');

});
