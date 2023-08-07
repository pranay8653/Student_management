<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\SessionController;
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
    return view('welcome');
});
// Route::view('/test',['admin.test']); this route checking for middleware
Route::view('/login',['login'])->name('login');
Route::post('/save_login',[SessionController::class, 'login'])->name('post.login');

//Forgot Password
Route::get('/forgot',[ForgotPasswordController::class,'forgot'])->name('forgot.password');
Route::post('/post_forgot',[ForgotPasswordController::class,'post_forgot'])->name('save.forgot.password');
Route::get('/reset_password',[ForgotPasswordController::class,'reset'])->name('reset.password');
Route::post('/post_reset',[ForgotPasswordController::class,'post_reset'])->name('reset.forgot.password');



// Admin
Route::get('/admin_register',[AdminController::class, 'index'])->name('admin.register');
Route::post('/save_register',[AdminController::class, 'admin_save_data'])->name('admin.save.register');

Route::middleware('auth:web')->group(function(){
    Route::get('/change_password', [ForgotPasswordController::class,'change_password'])->name('change.password');
    Route::post('/update_change_password', [ForgotPasswordController::class,'save_change_password'])->name('save.change.password');
    Route::get('/logout',[SessionController::class, 'logout'])->name('logout');

    Route::group(['middleware' => ['checkuser:admin']],function(){
        Route::view('/dashboard',['admin.dashboard'])->name('admin.dashboard');
        Route::get('/admin/profile',[AdminController::class,'admin_profile'])->name('admin.profile');
        Route::put('/admin/profile/picture',[AdminController::class,'admin_profile_picture'])->name('admin.profile.picture');

    });
});
