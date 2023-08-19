<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;


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
    Route::get('/logout',[SessionController::class, 'logout'])->name('logout');

    // Only Access Admin
    Route::group(['middleware' => ['checkuser:admin']],function(){
        Route::view('/dashboard',['admin.dashboard'])->name('admin.dashboard');
        Route::get('/admin/change_password', [AdminController::class,'change_password'])->name('admin.change.password');
        Route::put('/update_change_password', [AdminController::class,'admin_save_change_password'])->name('admin.update.password');
        Route::get('/admin/profile',[AdminController::class,'admin_profile'])->name('admin.profile');
        Route::put('/admin/profile/picture',[AdminController::class,'admin_profile_picture'])->name('admin.profile.picture');
        Route::get('/admin/profile/edit',[AdminController::class,'admin_profile_edit'])->name('admin.profile.edit');
        Route::put('/admin/profile/update',[AdminController::class,'admin_profile_update'])->name('admin.profile.update');
        Route::get('/admin/department',[AdminController::class,'create_department'])->name('departments');
        Route::post('/admin/save/department',[AdminController::class,'save_department'])->name('save.department');
        Route::get('/admin/edit/department/{id}',[AdminController::class,'edit_department'])->name('edit.department');
        Route::put('/admin/update/department/{id}',[AdminController::class,'update_department'])->name('update.department');
        // Route::get('/admin/delete/department/{id}',[AdminController::class,'department_delete'])->name('delete.department');
        Route::post('/admin/import/department/',[AdminController::class,'department_import'])->name('import.department');

        //teacher
        Route::get('/admin/create/teacher',[TeacherController::class,'teacher'])->name('create.teacher');
        Route::post('/admin/save/teacher',[TeacherController::class,'teacher_save_data'])->name('save.teacher');
        Route::get('/admin/show/teacher',[TeacherController::class,'show_teacher'])->name('show.teacher');
        Route::get('/admin/edit/teacher/{id}',[TeacherController::class,'edit_teacher'])->name('edit.teacher');
        Route::put('/admin/update/teacher/{id}',[TeacherController::class,'update_teacher'])->name('update.teacher');
        Route::get('/admin/delete/teacher/{id}',[TeacherController::class,'teacher_delete'])->name('delete.teacher');
        Route::get('/admin/teacher/export',[TeacherController::class,'export_teacher'])->name('export.teacher');
        Route::get('/admin/teacher/pdf', [TeacherController::class, 'teacher_list_pdf'])->name('teacher.pdf.list');
        Route::get('/admin/teacher/particular/lists/{id}', [TeacherController::class, 'perticular_list'])->name('teacher.particular.list');
        Route::get('/admin/teacher/particular/lists/pdf/{id}', [TeacherController::class, 'perticular_list_pdf'])->name('teacher.particular.list.pdf');

        //student
        Route::get('/admin/create/student',[StudentController::class,'index'])->name('create.student');
        Route::post('/admin/save/student',[StudentController::class,'student_save_data'])->name('save.student');
        Route::get('/admin/show/student',[StudentController::class,'show_student'])->name('show.student');
        Route::get('/admin/student/particular/lists/{id}', [StudentController::class, 'perticular_list'])->name('student.particular.list');
        Route::get('/admin/edit/student/{id}',[StudentController::class,'edit_student'])->name('edit.student');
        Route::put('/admin/update/student/{id}',[StudentController::class,'update_student'])->name('update.student');
        Route::get('/admin/delete/student/{id}',[StudentController::class,'student_delete'])->name('delete.student');
        Route::get('/admin/student/export',[StudentController::class,'export_student'])->name('export.student');
        Route::get('/admin/student/pdf', [StudentController::class, 'student_list_pdf'])->name('student.pdf.list');
    });

    // Access Both Admin & Teacher
    Route::group(['middleware' => ['checkuser:teacher']],function(){
        Route::view('/teacher/dashboard',['teacher.dashboard'])->name('teacher.dashboard');
        Route::get('/teacher/profile',[TeacherController::class,'teacher_profile'])->name('teacher.profile');
        Route::put('/teacher/profile/picture',[TeacherController::class,'teacher_profile_picture'])->name('teacher.profile.picture');
        Route::get('/teacher/profile/edit',[TeacherController::class,'teacher_profile_edit'])->name('teacher.profile.edit');
        Route::put('/teacher/profile/update',[TeacherController::class,'teacher_profile_update'])->name('teacher.profile.update');
        Route::get('/teacher/change_password', [TeacherController::class,'change_password'])->name('teacher.change.password');
        Route::put('/teacher/update_password', [TeacherController::class,'teacher_save_change_password'])->name('teacher.update.password');
    });
});


//this function checking for Eloquent: Relationships
// Route::get('/check', function () {
// $dep = department::with('users')->get() ;
// return $dep;
// });
