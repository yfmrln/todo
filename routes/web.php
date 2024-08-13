<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TodoController;

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

// 初期画面
Route::get('/', [TodoController::class, 'index'])->name('list');
// 今日のタスク画面
Route::get('/today', [TodoController::class, 'today'])->name('today');
// タスク完了画面
Route::get('/complete', [TodoController::class, 'complete'])->name('complete');
// 詳細を表示
Route::get('/get-data/{id}', [TodoController::class, 'getData']);
// 登録画面を表示
Route::get('/create', [TodoController::class, 'create'])->name('create');
// 登録処理
Route::post('/store', [TodoController::class, 'store'])->name('store');
// ステータスを更新
Route::post('/update-status', [TodoController::class, 'updateStatus']);


