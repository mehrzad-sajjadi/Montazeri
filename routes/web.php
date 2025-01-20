<?php

use App\Http\Controllers\AdsController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RequestController;
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
    Route::get("/{student}/show/company",[TeacherController::class,"studentCompany"])->name("teacher.student.company");

    Route::get("{report}/report/show",[TeacherController::class,"showReport"])->name("teacher.student.report.show");
    Route::delete("/{student}/delete",[TeacherController::class,"delete"])->name("teacher.student.delete");

});


Route::prefix("/faculty")->middleware(['auth', 'verified',IsFaculty::class])->group(function(){
    Route::get("/",[FacultyController::class,"index"])->name("faculty.index");
    Route::get("/create",[FacultyController::class,"create"])->name("faculty.teacher.create");
    Route::post("/",[FacultyController::class,"store"])->name("faculty.teacher.store");
    Route::get("/{teacher}/show",[FacultyController::class,"show"])->name("faculty.teacher.show");
    Route::delete("/{teacher}/delete",[FacultyController::class,"delete"])->name("faculty.teacher.delete");
});


Route::prefix("/company")->middleware(['auth', 'verified'])->group(function(){
    Route::get("/",[CompanyController::class,"index"])->name("company.index");
    Route::get("/create",[CompanyController::class,"create"])->name("company.create");
    Route::post("/",[CompanyController::class,"store"])->name("company.store");
    Route::get("{company}/show",[CompanyController::class,"show"])->name("company.show");
});

Route::prefix("/intern")->middleware(['auth', 'verified'])->group(function(){
    Route::get("/create",[InternController::class,"create"])->name("intern.create");
    Route::get("{intern}/show",[InternController::class,"show"])->name("intern.show");
    Route::post("/",[InternController::class,"store"])->name("intern.store");
    Route::get("{intern}/edit",[InternController::class,"edit"])->name("intern.edit");
    Route::put("{intern}/update",[InternController::class,"update"])->name("intern.update");
    Route::delete("{intern}/delete",[InternController::class,"delete"])->name("intern.delete");

    Route::get("/",[InternController::class,"index"])->name("intern.index");
});


Route::prefix("/ads")->middleware(['auth', 'verified'])->group(function(){
    Route::get("/{intern}/details",[AdsController::class,"show"])->name("ads.show");
});


Route::prefix("/request")->middleware(['auth', 'verified'])->group(function(){
    Route::get("/",[RequestController::class,"index"])->name("request.index");
    Route::post("/",[RequestController::class,"store"])->name("request.store");

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
