<?php

use App\Http\Controllers\DasboardController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/dashboard', [DasboardController::class,'index'])->name('app.dashboard');


Route::prefix('admin')->group(function () {

});

Route::group(['as'=>'app.','prefix' => 'app','middleware' => ['auth']],function(){
    Route::resource('roles',RoleController::class);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
