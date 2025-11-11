<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::post('login', [AuthController::class, 'login']);
// Route::post('reset', [UserController::class, 'reset']);
// Route::post('validate-otp', [UserController::class, 'validateOtp']);
// Route::post('reset-password', [UserController::class, 'resetPassword']);
// Route::post('firebase-token', [UserController::class, 'updateFirebaseToken'])->middleware('throttle:1500,1');

// Route::middleware(['jwt.auth', 'api.rate_limit:1500,1'])->group(function () {
//     Route::get('users/listing', [UserController::class, 'index'])->middleware('throttle:1500,1');
//     Route::get('user/{id}', [UserController::class, 'show'])->middleware('throttle:1500,1');
//     Route::post('logout', [AuthController::class, 'logout'])->middleware('throttle:1500,1');
//     Route::get('alert-preset/listing/{id}', [AlertPresetController::class, 'index'])->middleware('throttle:1500,1');
//     Route::post('alert/send', [AlertPresetController::class, 'send'])->middleware('throttle:1500,1');
// });

// // APK public access
// Route::put('device', [DeviceController::class, 'update'])->middleware('throttle:1500,1'); // using DUID to update the device info/ insert new one
// Route::get('device-info/{id}', [DeviceController::class, 'show'])->middleware('throttle:1500,1');
// Route::post('device/packages', [DeviceController::class, 'getPackages'])->middleware('throttle:1500,1');
// // Route::get('apk/device/{id}', [DeviceController::class, 'show']);
// Route::get('device/status/{id}', [DeviceController::class, 'checkStatus'])->middleware('throttle:1500,1');
// Route::get('apk/command/job/{id}', [DeviceController::class, 'job'])->middleware('throttle:1500,1');
// Route::get('apk/command/jobs/{id}', [DeviceController::class, 'jobs'])->middleware('throttle:1500,1');


// Route::post('apk/command/execute/{id}', [InScheduleController::class, 'update'])->middleware('throttle:1500,1');
// Route::post('resource/image', [ResourceController::class, 'store'])->middleware('throttle:1500,1');
// Route::delete('/device/delete/{id}', [DeviceController::class, 'destroy'])->name('deleteDevice');

// route::post('/live-feeds/video-frame', [DeviceController::class, 'handleVideoFrame'])->name('liveFeeds');

// // Route::get('logs', [LogController::class, 'index']);

// // Route::get('users/listing', [UserController::class, 'index']);
// // Route::get('devices/listing', [DeviceController::class, 'index']);

// // Live feeds
// Route::post('devices/upload-live-feed', [DeviceController::class, 'uploadLiveFeed']);

// Route::apiResources([
//     'user' => UserController::class,
//     'command' => CommandController::class,
//     'group' => GroupController::class,
// ]);
