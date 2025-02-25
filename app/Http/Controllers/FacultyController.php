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
            $array["date"]      = ["key"=>"date","data"=>$record->name . " " . $record->last_name ,"type"=>"text" ] ;
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
            'last_name' => 'required|string|max:255',
            'code_id' => 'required|regex:/^[0-9]{10}$/|digits:10|unique:'.User::class,
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user = new User();

        $user->name = $request->name ;
        $user->last_name = $request->last_name ;
        $user->code_id = $request->code_id ;

        $user->email = $request->email ;
        if($request->isFaculty){
            $user->level = 2;
        }else{
            $user->level = 1;
        }

        $user->password = Hash::make($request->password);
        
        $user->save();
        return Redirect()->route("faculty.index");
    }

    //لیست دانشجویان یک استاد

    public function show($teacherId){
        $teacher = User::find($teacherId);
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

        $header = ["نام دانشجو", "عملیات"];
        return Inertia::render("Faculty/TeacherStudents",compact("students","header","teacher"));
    }



    public function delete($teacherId){
        $teacher = User::find($teacherId);
        $teacher->delete();
        return redirect()->route("faculty.index")->with("message","استاد مورد نظر حذف شد");
    }

}
