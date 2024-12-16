<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Report;
use App\Models\Student;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use App\Helpers\DateConvertor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function index(){
        $students = Student::where('teacher_id',Auth::user()->id)->with('user')->get()->map(function($record){
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
        return Inertia::render("Teacher/StudentsList",compact("students","header"));
    }


    

    //دیدن گزارشات یک دانشجو
    public function show(Student $student){
        $reports = Report::where("student_id",$student->id)->latest()->get()->map(function($record){
            $array=[];
            $array["date"]      = ["key"=>"date","data"=>Jalalian::fromFormat('Y-m-d H:i:s', DateConvertor::miladi2shamsi($record->date))->format("Y/m/d"),"type"=>"text", ] ;
            $array["button"]    = [ "type"=>"button",
                "items"=>[
                    ["data"=>route("teacher.student.report.show",$record->id)     ,  "method"=>"get"      ,"value"=>"نمایش"           , "type"=>"show"        ],
                ],
            ];
            return $array;
        });
        $header = ["تاریخ گزارش", "عملیات"];
        return Inertia::render("Teacher/StudentReportList",compact("reports","header","student"));
    }


    public function showReport(Report $report){
        $date = Jalalian::fromFormat('Y-m-d H:i:s', DateConvertor::miladi2shamsi( $report->date))->format("Y/m/d");
        if($report->image){
            $image_url = Storage::url("pics/".$report->image);
            $image_name = $report->image;
            return Inertia::render("Teacher/StudentReportShow",compact("report","image_url","image_name","date"));
        }else{
            return Inertia::render("Teacher/StudentReportShow",compact("report","date"));
        }

    }

    public function studentCompany(Student $student){
        $start_date = DateConvertor::miladi2shamsi($student->start_date);
        $start_date = Jalalian::fromFormat("Y-m-d H:i:s", $start_date)->format("Y/m/d") ;
        return Inertia::render("Teacher/StudentCompany",compact("student","start_date"));
    }


}
