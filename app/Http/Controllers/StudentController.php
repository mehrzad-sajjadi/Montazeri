<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Helpers\DateConvertor;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\studentRequest;

class StudentController extends Controller
{

    public function create(){
        if(Auth::user()->level>0){
            return redirect()->route("teacher.index");
        }
        $student = Student::where("user_id",Auth::id())->first();
        if($student){
            return redirect()->route("report.index");
        }else{
            $teachers = User::where("level",">",0)->get();
            return Inertia::render("Dashboard",compact("teachers"));
        }
    }

    public function store(studentRequest $studentRequest){
        $startDate    = DateConvertor::shamsi2miladi( $studentRequest->start_date);

        $student = new Student();
        $student->user_id =  $studentRequest->user_id;

        $student->teacher_id =  $studentRequest->teacher_id;

        $student->company =  $studentRequest->company;
        $student->start_date =   $startDate ;
        $student->address =  $studentRequest->address;

        $student->boss_name =  $studentRequest->boss_name;
        $student->phone =  $studentRequest->phone;
        $student->save();
        return redirect()->route("report.index");
    }



}
