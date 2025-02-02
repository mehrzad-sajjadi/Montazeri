<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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


    public function index(Request $request){
        $search = $request->input('search');
        
        // $students = Student::where('teacher_id', Auth::user()->id)
        // ->when($search, function ($query, $search) {
        //     $query->whereHas('user', function ($q) use ($search) {
        //         $q->where('name', 'like', '%' . $search . '%');
        //     })->orWhereHas('user', function ($q) use ($search) {
        //         $q->where('last_name', 'like', '%' . $search . '%');
        //     });
        // })->with("user")->get()->map(function($record){
        //     $array=[];
    
        //     $array["name"]      = ["key"=>"date","data"=>$record->user_name ." ". $record->last_name  ,"type"=>"text", ] ;
        //     $array["code_id"]      = ["key"=>"date","data"=>$record->code_id  ,"type"=>"text", ] ;
        //     $array["button"]    = [ "type"=>"button",
        //         "items"=>[
        //             ["data"=>route("teacher.student.reports",$record->id)     ,  "method"=>"get"      ,"value"=>"نمایش"           , "type"=>"show"        ],
        //         ],
        //     ];
        //     return $array;
        // });
        $students = Student::where('teacher_id', Auth::user()->id)
        ->when($search, function ($query, $search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('code_id', 'like', '%' . $search . '%');
            });
            })->with("user")->get()->map(function($record){
            $array=[];
    
            $array["name"]      = ["key"=>"date","data"=>$record->user_name ." ". $record->last_name  ,"type"=>"text", ] ;
            $array["code_id"]      = ["key"=>"date","data"=>$record->code_id  ,"type"=>"text", ] ;
            $array["button"]    = [ "type"=>"button",
                "items"=>[
                    ["data"=>route("teacher.student.reports",$record->id)     ,  "method"=>"get"      ,"value"=>"نمایش"           , "type"=>"show"        ],
                ],
            ];
            return $array;
        });
        
        $header = ["نام و نام خانوادگی دانشجو","کد ملی", "عملیات"];
        return Inertia::render("Teacher/StudentsList",compact("students","header"));
    }

    public function delete(Student $student){
        $student->delete();
        return redirect()->route("teacher.index");
    }
    

    //دیدن گزارشات یک دانشجو
    public function show(Student $student){

        $reports = Report::where("student_id", $student->id)->get();




        $reminderInMinutes = 270 * 60; // 270 ساعت به دقیقه تبدیل می‌شود

        $totalMinutes = 0;

        foreach ($reports as $record) {
            $start = Carbon::parse($record->start_time);
            $end = Carbon::parse($record->end_time);

            $totalMinutes += $start->diffInMinutes($end);
        }


        $totalHours = floor($totalMinutes / 60);
        $totalMinutes = $totalMinutes % 60;

        $totalTime = "{$totalHours}:{$totalMinutes}";
        
        //میزان اختلاف
        $differenceInMinutes = $reminderInMinutes - ($totalHours * 60 + $totalMinutes);
        $differenceHours = floor($differenceInMinutes / 60);
        $differenceMinutes = $differenceInMinutes % 60;

        $reminder = "{$differenceHours}:{$differenceMinutes}";
        
        if($reminder<="00:00"){
            $reminder= "00:00";
        }

        $reports = Report::where("student_id",$student->id)->latest()->get()->map(function($record){
            $date = Jalalian::fromFormat('Y-m-d H:i:s', DateConvertor::miladi2shamsi($record->date));

            $array=[];
            $array["day"]      = ["key"=>"date","data"=>$date->format("%A"),"type"=>"text", ] ;

            $array["date"]      = ["key"=>"date","data"=>Jalalian::fromFormat('Y-m-d H:i:s', DateConvertor::miladi2shamsi($record->date))->format("Y/m/d"),"type"=>"text", ] ;

            $array["button"]    = [ "type"=>"button",
                "items"=>[
                    ["data"=>route("teacher.student.report.show",$record->id)     ,  "method"=>"get"      ,"value"=>"نمایش"           , "type"=>"show"        ],
                ],
            ];
            return $array;
        });
        $header = ["روز","تاریخ گزارش", "عملیات"];
        return Inertia::render("Teacher/StudentReportList",compact("reports","header","student","totalTime","reminder"));
    }


    public function showReport(Report $report){

        $date = Jalalian::fromFormat('Y-m-d H:i:s', DateConvertor::miladi2shamsi($report->date))->format("Y/m/d");
        $start_time = Jalalian::forge($report->start_time)->format("H:i");
        $end_time = Jalalian::forge($report->end_time)->format("H:i");
    

        $image_url = null;
        $image_name = null;
        $video_url = null;
        $video_name = null;
    

        if ($report->image) {
            $image_url = Storage::url("pics/" . $report->image);
            $image_name = $report->image;
        }
    

        if ($report->video) {
            $video_url = Storage::url("movie/" . $report->video);
            $video_name = $report->video;
        }
    

        return Inertia::render("Report/show", compact("report", "image_url", "image_name", "video_url", "video_name", "date", "start_time", "end_time"));    
    }

    //دیدن شرکت دانشجو
    public function studentCompany(Student $student){
        $start_date = DateConvertor::miladi2shamsi($student->start_date);
        $start_date = Jalalian::fromFormat("Y-m-d H:i:s", $start_date)->format("Y/m/d") ;
        $daysMap = [
            'شنبه' => $student->saturday,
            'یکشنبه' => $student->sunday,
            'دوشنبه' => $student->monday,
            'سه شنبه' => $student->tuesday,
            'چهارشنبه' => $student->wednesday,
            'پنجشنبه' => $student->thursday,
        ];
    
        // فیلتر کردن روزهایی که مقدار 1 دارند
        $days = array_keys(array_filter($daysMap, function ($value) {
            return $value == 1;
        }));

        
        return Inertia::render("Teacher/StudentCompany",compact("student","start_date","days"));
    }


}
