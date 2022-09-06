<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\IdiomController;
use App\Http\Controllers\DhivehiNameController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\UserController;

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
})->name('home');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/rules', [ViewController::class, 'rules']);
Route::get('/idioms', [ViewController::class, 'idioms']);
Route::get('/linguists', [ViewController::class, 'linguists']);
Route::get('/dhivehiNames', [ViewController::class, 'dhivehiNames']);
Route::get('/dhivehiDates', [ViewController::class, 'dhivehiDates']);

// Routes for Rule Controller
Route::prefix('/admin/rules')->group(function(){
    Route::get('/', [RuleController::class, 'index']);
    Route::post('/create', [RuleController::class, 'create']);
    Route::post('/update', [RuleController::class, 'update']);
    Route::post('/delete', [RuleController::class, 'delete']);
});

// Routes for Idiom Controller
Route::prefix('/admin/idioms')->group(function(){
    Route::get('/', [IdiomController::class, 'index']);
    Route::post('/create', [IdiomController::class, 'create']);
    Route::post('/update', [IdiomController::class, 'update']);
    Route::post('/delete', [IdiomController::class, 'delete']);
});

// Routes for Dhivehi Names Controller
Route::prefix('/admin/dhivehiNames')->group(function(){
    Route::get('/', [DhivehiNameController::class, 'index']);
    Route::post('/create', [DhivehiNameController::class, 'create']);
    Route::post('/update', [DhivehiNameController::class, 'update']);
    Route::post('/delete', [DhivehiNameController::class, 'delete']);
});

// Routes for Dhivehi Dates Controller
Route::prefix('/admin/dhivehiDates')->group(function(){
    Route::get('/', [HistoryController::class, 'index']);
    Route::post('/create', [HistoryController::class, 'create']);
    Route::post('/update', [HistoryController::class, 'update']);
    Route::post('/delete', [HistoryController::class, 'delete']);
});

// Routes for User Controller
Route::prefix('/admin/users')->group(function(){
    Route::get('/', [UserController::class, 'index']);
    Route::post('/create', [UserController::class, 'create']);
    Route::post('/update', [UserController::class, 'update']);
    Route::post('/delete', [UserController::class, 'delete']);
});
