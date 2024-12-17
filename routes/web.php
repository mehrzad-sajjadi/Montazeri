<?php

use App\Http\Controllers\FacultyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Middleware\IsFaculty;
use App\Http\Middleware\Register;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;






Route::get('/',function(){
    return redirect()->route("student.create");
})->middleware(['auth', 'verified',Register::class]);

Route::prefix("/student")->middleware(['auth', 'verified'])->group(function(){
    Route::get('/create',[StudentController::class,"create"])->name("student.create");
    Route::post('/',[StudentController::class,"store"])->name("student.store");


});
Route::prefix("/report")->middleware(['auth', 'verified'])->group(function(){
    Route::get("/",[ReportController::class,"index"])->name("report.index");
    Route::get("/create",[ReportController::class,"create"])->name("report.create");
    Route::post("/",[ReportController::class,"store"])->name("report.store");
    Route::get("{report}/show",[ReportController::class,"show"])->name("report.show");
    Route::get("{report}/edit",[ReportController::class,"edit"])->name("report.edit");
    Route::put("/{report}/update",[ReportController::class,"update"])->name("report.update");
    Route::delete("{report}/delete",[ReportController::class,"delete"])->name("report.delete");
});

Route::prefix("/teacher")->middleware(['auth', 'verified'])->group(function(){
    Route::get("/",[TeacherController::class,"index"])->name("teacher.index");
    Route::get("/{student}/show",[TeacherController::class,"show"])->name("teacher.student.reports");
    Route::get("{report}/report/show",[TeacherController::class,"showReport"])->name("teacher.student.report.show");
    Route::get("/{student}/company",[TeacherController::class,"studentCompany"])->name("teacher.student.company");

});


Route::prefix("/faculty")->middleware(['auth', 'verified',IsFaculty::class])->group(function(){
    Route::get("/",[FacultyController::class,"index"])->name("faculty.index");
    Route::get("/create",[FacultyController::class,"create"])->name("faculty.teacher.create");
    Route::post("/",[FacultyController::class,"store"])->name("faculty.teacher.store");

    


});















Route::get('/dashboard', function () {
    return redirect()->route("student.create");
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
