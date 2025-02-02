<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Helpers\DateConvertor;
use App\Http\Requests\reportRequest;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Morilog\Jalali\Jalalian;




class ReportController extends Controller
{
    public function index(){

        if(Auth::user()->level!=0){
            return redirect()->back();
        }
        
        
        $reports = Report::where("student_id", Auth::user()->student_id)->latest()->get();
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

        $reports = Report::where("student_id",Auth::user()->student_id)->latest()->get()->map(function($record){
            $date = Jalalian::fromFormat('Y-m-d H:i:s', DateConvertor::miladi2shamsi($record->date));


            $array=[];
            $array["day"]      = ["key"=>"date","data"=>$date->format("%A"),"type"=>"text", ] ;
           
            $array["date"]      = ["key"=>"date","data"=>Jalalian::fromFormat('Y-m-d H:i:s', DateConvertor::miladi2shamsi($record->date))->format("Y/m/d"),"type"=>"text", ] ;
            $array["button"]    = [ "type"=>"button",
                "items"=>[
                    ["data"=>route("report.show",$record->id)     ,  "method"=>"get"            ,"value"=>"نمایش"           , "type"=>"show"        ],
                ],
            ];
            return $array;
        });
        $header = ["روز","تاریخ گزارش", "عملیات"];
        return Inertia::render("Report/index",compact("reports","header","totalTime","reminder"));
    }

    public function create(){

        $now = Jalalian::now()->format("Y/m/d");
        $studentId = Auth::user()->student_id;
        return Inertia::render("Report/create",compact("now","studentId"));
    }

    public function store(reportRequest $reportRequest)
    {
        $date = DateConvertor::shamsi2miladi($reportRequest->date);
        $check = Report::where("date", $date)->where("student_id", $reportRequest->student_id)->first();
        if ($check) {
            return redirect()->route("report.create")->with("error", "شما قبلا در این تاریخ گزارش خود را ثبت کرده اید");
        }
        $report = new Report();
        $report->text = $reportRequest->text;
        $report->date = $date;
        $report->start_time = $reportRequest->start_time;
        $report->end_time = $reportRequest->end_time;
        $report->student_id = $reportRequest->student_id;
        if ($reportRequest->hasFile('image')) {
            $image = $reportRequest->file("image");
            $type = $image->getClientOriginalExtension();
            $time = time();
            $image_name = $time . "." . $type;
            $image->storeAs('pics', $image_name, 'public');
            $report->image = $image_name;
        }
        // ذخیره ویدیو در صورت وجود
        if ($reportRequest->hasFile('video')) {
            $video = $reportRequest->file("video");
            $type = $video->getClientOriginalExtension();
            $time = time();
            $video_name = $time . "_video." . $type;
            $video->storeAs('movie', $video_name, 'public');
            $report->video = $video_name;
        }
        $report->save();
        return redirect()->route('report.index')->with("message", "گزارش شما با موفقیت اضافه شد");
    }
    
    
    public function show(Report $report)
    {
    
        Gate::authorize("view", $report);
    
    
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
    
        // ارسال داده‌ها به نمای Inertia
        return Inertia::render("Report/show", compact("report", "image_url", "image_name", "video_url", "video_name", "date", "start_time", "end_time"));
    }
    
    public function edit(Report $report){
        Gate::authorize("view",$report);

        $date = Jalalian::fromFormat('Y-m-d H:i:s', DateConvertor::miladi2shamsi( $report->date))->format("Y/m/d");
        $now = Jalalian::now()->format("Y/m/d");
        $studentId = Auth::user()->student_id;
        if($report->image){
            $image_url = Storage::url("pics/".$report->image);
            $image_name = $report->image;
            return Inertia::render("Report/edit",compact("report","image_url","image_name","date","now","studentId","report"));
        }else{
            return Inertia::render("Report/edit",compact("now","studentId","report","date"));
        }
    }
    public function update(reportRequest $reportRequest,Report $report){
        $date = DateConvertor::shamsi2miladi( $reportRequest->date);
        
        $report->text = $reportRequest->text;
        $report->date = $date;
        $report->student_id = $reportRequest->student_id;
        if ($reportRequest->hasFile('image')) {
            // حذف تصویر قبلی اگر وجود داشته باشد
            if ($reportRequest->image) {
                unlink(storage_path('app/public/pics/' . $report->image));
            }
            $image = $reportRequest->file("image") ;
            $type = $image->getClientOriginalExtension();
            $time = time();
            $image_name = $time.".".$type;
            $image->storeAs('pics', $image_name, 'public');
            $report->image = $image_name ; 
        }
        $report->save();
        return redirect()->route('report.index')->with("message","گزارش شما با ویرایش اضافه شد");

    }






    public function delete(Report $report){
        Gate::authorize("delete",$report);
        if($report->image){
            unlink(storage_path('app/public/pics/' . $report->image));
        }
        $report->delete();
        return redirect()->route("report.index")->with("message","گزارش مورد نظر با موفقیت حذف شد");
    }

 
}






