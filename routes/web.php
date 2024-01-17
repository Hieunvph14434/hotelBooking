<?php

use App\Http\Controllers\Cms\CategoryController;
use App\Http\Controllers\Cms\RoomController;
use App\Http\Controllers\Cms\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

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
    // return view('welcome');
    return view('layouts.cms.master');
});

Route::prefix('/users')->controller(UserController::class)->name('users.')->group(function() {
    Route::get('/', 'index')->name('list');
    Route::get('/create', 'create')->name('create');
    Route::post('/create', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::put('/edit/{id}', 'update')->name('update');
    Route::delete('/delete/{id}', 'destroy')->name('delete');
});

Route::prefix('/room-types')->controller(CategoryController::class)->name('roomTypes.')->group(function() {
    Route::get('/', 'index')->name('list');
    Route::get('/create', 'create')->name('create');
    Route::post('/create', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::put('/edit/{id}', 'update')->name('update');
    Route::delete('/delete/{id}', 'destroy')->name('delete');
});

Route::prefix('/rooms')->controller(RoomController::class)->name('rooms.')->group(function() {
    Route::get('/', 'index')->name('list');
    Route::get('/create', 'create')->name('create');
    Route::post('/create', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::put('/edit/{id}', 'update')->name('update');
    Route::delete('/delete/{id}', 'destroy')->name('delete');
});

Route::delete('/cloudinary-delete', function(Request $request) {
    $statusCode = 200;
    $message = "";
    $image = $request->image ?? null;
    try {
        if(! is_null($image)) {
            $pathinfo = pathinfo($image);
            $publicId = $pathinfo['dirname'] . '/' . $pathinfo['filename'];
            deleteFile($publicId);
        }
        $message = "Delete image successfully!";
    } catch (\Exception $exception) {
        if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            $message = "Resource not found";
            $statusCode = 404;
        } else {
            $message = "Internal Server Error";
            $statusCode = 500; 
        }
        Log::error($exception->getMessage());
    }
    return json_encode([
        'statusCode' => $statusCode,
        'message' => $message,
    ]);
})->name('delete.image.cloudinary');

Route::get('/pageLogin', function(){
    return view('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
