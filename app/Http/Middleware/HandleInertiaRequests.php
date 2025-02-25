<?php

namespace App\Http\Middleware;

use App\Models\Student;
use App\Models\User;
use Inertia\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),    
            ],            
            "crud"=>[
                "success"=>session("message"),
                "errors"=>session("error"),
            ],
            "menu"=> function () use($request) { 
                if(!$request->user()){
                    return [];
                }
                $user = Auth::user();
                $isTeacher = $user->isTeacher();
                $isStudent = $user->isStudent()  && $user->is_company==0 ;
                $isFaculty = Auth::user()->level > 1 && $user->is_company==0;
                $is_company = $user->is_company==1;
                return [
                    [
                        'name'   => 'ثبت محل کارآموزی',
                        'route'  => 'student.create',
                        'show'   => $request->user() ? $user->level == 0 && !$isStudent && $user->is_company==0 :false ,
                        'active' => Route::is('student.create'),
                    ],
                    [
                        'name'   => 'گزارشات',
                        'route'  => 'report.index',
                        'show'   => $isStudent,
                        'active' => Route::is("report.index") || Route::is("report.create") || Route::is("report.edit") || Route::is("report.show"),
                    ],
                    [
                        'name'   => 'دانشجویان',
                        'route'  => 'teacher.index',
                        'show'   => $isTeacher,
                        'active' => Route::is("teacher.index") || Route::is("teacher.student.reports") || Route::is("teacher.student.report.show")
                    ],
                    [
                        'name'   => 'اساتید',
                        'route'  => 'faculty.index',
                        'show'   => $isFaculty ,
                        'active' => Route::is("faculty.index") ||  Route::is("faculty.teacher.show") || Route::is("faculty.teacher.create") 
                    ],
                    [
                        'name'   => 'شرکت',
                        'route'  => 'company.index',
                        'show'   => $is_company ,
                        'active' => Route::is("company.index") || Route::is("company.create") 
                    ],
                    [
                        'name'   => 'آگهی کارآموزی',
                        'route'  => 'intern.index',
                        'show'   => !$is_company ,
                        'active' => Route::is("intern.index") ||  Route::is("ads.show") ||  Route::is("company.show") 
                    ],


                    [
                        'name'   => 'درخواست های کارآموزی',
                        'route'  => 'request.index',
                        'show'   => $is_company ,
                        'active' => Route::is("request.index")
                    ],


                ];
               
            }
        ];    
    }
}