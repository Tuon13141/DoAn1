<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HostController;
use App\Http\Controllers\PageController;
use App\Models\Room;
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

    Route::get('/help', function () {
        return view('help');
    })->name('help');

    Route::get('/notification', [PageController::class, 'notificationController']
    )->name('notification');

    Route::get('/aboutNotification/answer_id={notification_id}', [PageController::class, 'aboutNotification']
    )->name('aboutNotification');

    Route::post('/help', [PageController::class, 'helpController'])->name('sendHelp');

    Route::middleware('host_access')->group(function () {
        Route::get('/hostMotel', [HostController::class, 'showMotel']
        )->name('hostMotel');

        Route::get('/addMotel', function () {
            return view('addMotel');
        })->name('addMotel');

        Route::get('/aboutMotel/{motel_id}', [HostController::class, 'processAboutMotel'])->name('aboutMotel');

        Route::post('/aboutMotel/{motel_id}', [HostController::class, 'processChangeAboutMotel'])->name('processChangeAboutMotel');

        Route::post('/addMotel', [HostController::class, 'processAddMotel'])->name('processAddMotel');

        Route::get('/aboutMotel/{motel_id}/delete', [HostController::class, 'processDeleteMotel'])->name('deleteMotel');

        Route::get('/aboutMotel/{motel_id}/aboutRoom/{room_id}', [HostController::class, 'processAboutRoom'])->name('aboutRoom');

        Route::post('/aboutMotel/{motel_id}/aboutRoom/{room_id}', [HostController::class, 'processChangeAboutRoom'])->name('changeAboutRoom');

        Route::get('/aboutMotel/{motel_id}/addRoom', [HostController::class, 'addRoom'])->name('addRoom');

        Route::post('/aboutMotel/{motel_id}/addRoom', [HostController::class, 'processAddRoom'])->name('processAddRoom');

        Route::get('/aboutMotel/{motel_id}/aboutRoom/{room_id}/delete', [HostController::class, 'processDeleteRoom'])->name('deleteRoom');

        Route::post('/aboutMotel/{motel_id}/addPicture', [HostController::class, 'processChangePictureMotel'])->name('changePictureMotel');

        Route::post('/aboutMotel/{motel_id}/aboutRoom/{room_id}/addPicture', [HostController::class, 'processChangePictureRoom'])->name('changePictureRoom');

        Route::get('/qcRoom/motel_id={motel_id}&room_id={room_id}', [HostController::class, 'qcRoom'])->name('qcRoom');

        Route::post('/qcRoom/motel_id={motel_id}&room_id={room_id}', [HostController::class, 'qcRoomController'])->name('qcRoomController');
    });

    Route::middleware('admin_access')->group(function () {
        Route::get('/adminQuestion/{type}', [AdminController::class, 'showQuestion']
        )->name('adminQuestion');

        Route::get('/aboutQuestion/question_id={question_id}', [AdminController::class, 'aboutQuestion']
        )->name('aboutQuestion');

        Route::get('/aboutAnswer/answer_id={answer_id}', [AdminController::class, 'aboutAnswer']
        )->name('aboutAnswer');

        Route::get('/aboutQcRoom/answer_id={answer_id}', [AdminController::class, 'aboutQcRoom']
        )->name('aboutQcRoom');

        Route::post('/answer/username={username}&question_id={question_id}', [AdminController::class, 'sendAnswer']
        )->name('sendAnswer');

        Route::get('/confirmQc/answer_id={answer_id}', [AdminController::class, 'confirmQc']
        )->name('confirmQc');

        Route::post('/confirmQc/host_username={username}&room_id={room_id}&answer_id={answer_id}', [AdminController::class, 'processConfirmQc']
        )->name('processConfirmQc');

        Route::post('/cancelQc/host_username={username}&room_id={room_id}&answer_id={answer_id}', [AdminController::class, 'cancelQc']
        )->name('cancelQc');
    }); 
});

Route::get('/hostRegister', function () {
    return view('hostRegister');
})->name('hostRegister');

Route::get('/page1', [PageController::class, 'page1Controller']
)->name('page1');

Route::get('/page2/randomView', [PageController::class, 'randomViewController'])->name('page2_randomView');

Route::get('/page2/orderedView', [PageController::class, 'viewPageController'])->name('page2_orderedView');

Route::post('/login', [AuthController::class, 'processLogin'])->name('processLogin');

Route::post('/registerUser', [AuthController::class, 'processRegister'])->name('processRegister');

Route::post('/registerHost', [AuthController::class, 'processHostRegister'])->name('processHostRegister');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/aboutMe', [AuthController::class, 'processChangeAboutMe'])->name(('processChangeAboutMe'));

Route::get('/viewRoom/motel_id={motel_id}&room_id={room_id}&host_username={host_username}}', [PageController::class, 'viewRoom'])->name('viewRoom');
