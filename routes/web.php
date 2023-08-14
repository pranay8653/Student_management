<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TeacherController;
use App\Models\Department;
use App\Models\User;
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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::view('/test',['admin.test']); this route checking for middleware
Route::view('/',['login'])->name('login');
Route::post('/save_login',[SessionController::class, 'login'])->name('post.login');

//Forgot Password
Route::get('/forgot',[ForgotPasswordController::class,'forgot'])->name('forgot.password');
Route::post('/post_forgot',[ForgotPasswordController::class,'post_forgot'])->name('save.forgot.password');
Route::get('/reset_password',[ForgotPasswordController::class,'reset'])->name('reset.password');
Route::post('/post_reset',[ForgotPasswordController::class,'post_reset'])->name('reset.forgot.password');



// Admin Registration
Route::get('/admin_register',[AdminController::class, 'index'])->name('admin.register');
Route::post('/save_register',[AdminController::class, 'admin_save_data'])->name('admin.save.register');

Route::middleware('auth:web')->group(function(){
    Route::get('/change_password', [ForgotPasswordController::class,'change_password'])->name('change.password');
    Route::get('/logout',[SessionController::class, 'logout'])->name('logout');

    Route::group(['middleware' => ['checkuser:admin']],function(){
        Route::view('/dashboard',['admin.dashboard'])->name('admin.dashboard');
        Route::post('/update_change_password', [ForgotPasswordController::class,'admin_save_change_password'])->name('save.change.password');
        Route::get('/admin/profile',[AdminController::class,'admin_profile'])->name('admin.profile');
        Route::put('/admin/profile/picture',[AdminController::class,'admin_profile_picture'])->name('admin.profile.picture');
        Route::get('/admin/profile/edit',[AdminController::class,'admin_profile_edit'])->name('admin.profile.edit');
        Route::put('/admin/profile/update',[AdminController::class,'admin_profile_update'])->name('admin.profile.update');
        Route::get('/admin/department',[AdminController::class,'create_department'])->name('departments');
        Route::post('/admin/save/department',[AdminController::class,'save_department'])->name('save.department');
        Route::get('/admin/edit/department/{id}',[AdminController::class,'edit_department'])->name('edit.department');
        Route::put('/admin/update/department/{id}',[AdminController::class,'update_department'])->name('update.department');
        // Route::get('/admin/delete/department/{id}',[AdminController::class,'department_delete'])->name('delete.department');

        //teacher
        Route::get('/admin/create/teacher',[TeacherController::class,'teacher'])->name('create.teacher');
        Route::post('/admin/save/teacher',[TeacherController::class,'teacher_save_data'])->name('save.teacher');
        Route::get('/admin/show/teacher',[TeacherController::class,'show_teacher'])->name('show.teacher');
        Route::get('/admin/edit/teacher/{id}',[TeacherController::class,'edit_teacher'])->name('edit.teacher');
        Route::put('/admin/update/teacher/{id}',[TeacherController::class,'update_teacher'])->name('update.teacher');
        Route::get('/admin/delete/teacher/{id}',[TeacherController::class,'teacher_delete'])->name('delete.teacher');
        Route::get('/admin/teacher/export',[TeacherController::class,'export_teacher'])->name('export.teacher');
        Route::get('/admin/teacher/pdf', [TeacherController::class, 'teacher_list_pdf'])->name('teacher.pdf.list');
    });
});


//this function checking for Eloquent: Relationships
// Route::get('/check', function () {
// $dep = department::with('users')->get() ;
// return $dep;
// });
