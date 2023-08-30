<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\QuerryController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;


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

    // Access Only Admin
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
        Route::get('/admin/student/export/particular_dept_all/{id}',[StudentController::class,'export_particular_department_excel'])->name('export.particular.dept.all.student');
    });

    // Access Only Teacher
    Route::group(['middleware' => ['checkuser:teacher']],function(){
        Route::view('/teacher/dashboard',['teacher.dashboard'])->name('teacher.dashboard');
        Route::get('/teacher/profile',[TeacherController::class,'teacher_profile'])->name('teacher.profile');
        Route::put('/teacher/profile/picture',[TeacherController::class,'teacher_profile_picture'])->name('teacher.profile.picture');
        Route::get('/teacher/profile/edit',[TeacherController::class,'teacher_profile_edit'])->name('teacher.profile.edit');
        Route::put('/teacher/profile/update',[TeacherController::class,'teacher_profile_update'])->name('teacher.profile.update');
        Route::get('/teacher/change_password', [TeacherController::class,'change_password'])->name('teacher.change.password');
        Route::put('/teacher/update_password', [TeacherController::class,'teacher_save_change_password'])->name('teacher.update.password');
        Route::get('/teacher/create/note',[TeacherController::class,'create_note'])->name('create.notes');
        Route::post('/teacher/save/note',[TeacherController::class,'save_note'])->name('save.notes');
        Route::get('/teacher/show/note',[TeacherController::class,'show_note'])->name('show.notes');
        Route::get('/teacher/load/more/{id}',[TeacherController::class,'load_more'])->name('load.notes');
        Route::get('/teacher/edit/note/{id}',[TeacherController::class,'edit_note'])->name('edit.notes');
        Route::put('/teacher/update/note/{id}',[TeacherController::class,'update_note'])->name('update.notes');
        Route::get('/teacher/delete/note/{id}',[TeacherController::class,'delete_notes'])->name('delete.notes');

        Route::post('/teacher/create/instruction',[ReplyController::class,'store_instruction']);
        Route::get('/teacher/show/querry/{id}',[ReplyController::class,'showquerry']);
        Route::get('/teacher/edit/querry/{id}',[ReplyController::class,'edit_querry']);
        Route::put('/teacher/update/querry/{id}',[ReplyController::class,'update_querry']);
        Route::get('/teacher/delete/querry/{id}',[ReplyController::class,'delete_querry']);
    });

    // Access Only Student
    Route::group(['middleware' => ['checkuser:student']],function(){
        Route::view('/student/dashboard',['student.dashboard'])->name('student.dashboard');
        Route::get('/student/profile',[StudentController::class,'student_profile'])->name('student.profile');
        Route::put('/student/profile/picture',[StudentController::class,'student_profile_picture'])->name('student.profile.picture');
        Route::get('/student/profile/edit',[StudentController::class,'student_profile_edit'])->name('student.profile.edit');
        Route::put('/student/profile/update',[StudentController::class,'student_profile_update'])->name('student.profile.update');
        Route::get('/student/change_password', [StudentController::class,'change_password'])->name('student.change.password');
        Route::put('/student/update_password', [StudentController::class,'student_save_change_password'])->name('student.update.password');
        Route::get('/student/show/note',[StudentController::class,'show_note'])->name('student.show.notes');
        Route::get('/student/load/more/{id}',[StudentController::class,'load_more'])->name('student.load.notes');
        Route::get('/student/perticular/note/pdf/{id}',[StudentController::class,'perticular_note_pdf'])->name('student.pdf.notes');
        Route::post('/create/querry',[QuerryController::class,'querry_store'])->name('add.querry');
        Route::get('/show/querry/{id}',[QuerryController::class,'showquerry']);
        Route::get('/edit/querry/{id}',[QuerryController::class,'edit_querry']);
        Route::put('/update/querry/{id}',[QuerryController::class,'update_querry']);
        Route::get('/delete/querry/{id}',[QuerryController::class,'delete_querry']);
    });
});

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::view('/test',['admin.test']); this route checking for middleware
//this function checking for Eloquent: Relationships
// Route::get('/check', function () {
// $dep = department::with('users')->get() ;
// return $dep;
// });
