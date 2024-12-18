<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Response;

class FacultyController extends Controller
{

    public function index(){
        $teachers = User::where("level",">",0)->whereNot("id",Auth::id())->get()->map(function($record){
            $array=[];
            $array["date"]      = ["key"=>"date","data"=>$record->name,"type"=>"text" ] ;
            $array["button"]    = [ "type"=>"button",
            "items"=>[
                ["data"=>route('faculty.teacher.show',$record->id)     ,  "method"=>"get"      ,"value"=>"نمایش"           , "type"=>"show"        ],
            ],
        ];
            return $array;
        });
        $header = ["نام استاد","عملیات"];
        return Inertia::render("Faculty/index",compact("teachers","header"));
    }

    public function create(){
        return Inertia::render("Faculty/create");
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user = new User();

        $user->name = $request->name ;
        $user->email = $request->email ;
        $user->level = 1 ;
        $user->password = Hash::make($request->password);
        
        $user->save();
        return Redirect()->route("faculty.index");
    }

    public function show($teacherId){
        $teacher = User::find($teacherId)->name;
        $students = Student::where('teacher_id',$teacherId)->get()->map(function($record){
            $array=[];
            $array["name"]      = ["key"=>"date","data"=>$record->user_name,"type"=>"text", ] ;
            $array["button"]    = [ "type"=>"button",
                "items"=>[
                    ["data"=>route("teacher.student.reports",$record->id)     ,  "method"=>"get"      ,"value"=>"نمایش"           , "type"=>"show"        ],
                ],
            ];
            return $array;
        });
        // dd($students);
        $header = ["نام دانشجو", "عملیات"];
        return Inertia::render("Faculty/TeacherStudents",compact("students","header","teacher"));
    }

}
