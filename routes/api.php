<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DummyAPICtrl;
use App\Http\Controllers\DeviceCtrl;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's
    Route::apiResource("member", MemberController::class);

    Route::get('list/{id?}', [DeviceCtrl::class, 'list']);
    Route::post('add', [DeviceCtrl::class, 'add']);
    Route::put('update', [DeviceCtrl::class, 'update']);
    Route::delete('delete/{id}', [DeviceCtrl::class, 'delete']);
    Route::get('search/{name}', [DeviceCtrl::class, 'search']);
    });

Route::get('data', [DummyAPICtrl::class, 'getData']);

Route::post("login",[UserController::class,'index']);
Route::post('upload', [FileController::class, 'upload']);
