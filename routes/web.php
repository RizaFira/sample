<?php

use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Stmt\Foreach_;
use Illuminate\Support\Facades\Storage;

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

Route::get('/', [App\Http\Controllers\SettingController::class, 'media'])->name('test');
Route::get('/setting', [App\Http\Controllers\SettingController::class, 'setting'])->name('setting');
Route::post('/setting/update', [App\Http\Controllers\SettingController::class, 'update'])->name('setting.update');
Route::get('/setting/delete-video', [App\Http\Controllers\SettingController::class, 'deleteVideo'])->name('delete.video');
Route::get('/setting/delete-image/{name}', [App\Http\Controllers\SettingController::class, 'deleteImage'])->name('delete.image');
Route::get('/video/{filename}', function ($filename) {
    $path = storage_path() . '/app/videos/' . $filename;

    if (!File::exists($path)) {
        return response()->json([
            'not found',
        ]);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header('Content-Type', $type);

    return $response;
})->name('video');

Route::get('/image/{filename}', function ($filename) {
    $path = storage_path() . '/app/images/' . $filename;
    if (!File::exists($path)) {
        return response()->json([
            'not found',
        ]);
    }
    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header('Content-Type', $type);

    return $response;
})->name('image');

