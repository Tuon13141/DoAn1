<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HostController;
use Illuminate\Support\Facades\Route;

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
    return view('index');
})->name('index');

Route::middleware('login_access')->group(function () {
    Route::get('/login', function () {
        return view('login');
    })-> name('login');
    
    Route::get('/register', function () {
        return view('register');
    })->name('register');
});

Route::middleware('user_access')->group(function () {
    Route::get('/myPage', function () {
        return view('myPage');
    })->name('myPage');

    Route::get('/aboutMe', function () {
        return view('aboutMe');
    })->name('aboutMe');

    Route::middleware('host_access')->group(function () {
        Route::get('/hostMotel', [HostController::class, 'showMotel']
        )->name('hostMotel');

        Route::get('/addMotel', function () {
            return view('addMotel');
        })->name('addMotel');

        Route::get('/aboutMotel/{id}', [HostController::class, 'processAboutMotel'])->name('aboutMotel');
    });
});

Route::get('/hostRegister', function () {
    return view('hostRegister');
})->name('hostRegister');

Route::get('/page1', function () {
    return view('buyPage_1');
})->name('page1');

Route::post('/login', [AuthController::class, 'processLogin'])->name('processLogin');

Route::post('/register', [AuthController::class, 'processRegister'])->name('processRegister');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/aboutMe', [AuthController::class, 'processAboutMe'])->name(('processAboutMe'));

Route::post('/addMotel', [HostController::class, 'processAddMotel'])->name('processAddMotel');