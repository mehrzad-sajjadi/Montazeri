<?php

namespace App\Http\Controllers;

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
        $reports = Report::where("student_id",Auth::user()->student_id)->latest()->get()->map(function($record){
            $array=[];
            $array["date"]      = ["key"=>"date","data"=>Jalalian::fromFormat('Y-m-d H:i:s', DateConvertor::miladi2shamsi($record->date))->format("Y/m/d"),"type"=>"text", ] ;
            $array["button"]    = [ "type"=>"button",
                "items"=>[
                    ["data"=>route("report.show",$record->id)     ,  "method"=>"get"      ,"value"=>"نمایش"           , "type"=>"show"        ],
                    ["data"=>route("report.edit",$record->id)     ,  "method"=>"get"      ,"value"=>"ویرایش"           , "type"=>"edit"        ],
                    ["data"=>route("report.delete",$record->id)     ,  "method"=>"delete"      ,"value"=>"حذف"           , "type"=>"delete"        ],
                ],
            ];
            return $array;
        });
        $header = ["تاریخ گزارش", "عملیات"];
        return Inertia::render("Report/index",compact("reports","header"));
    }
    public function create(){

        $now = Jalalian::now()->format("Y/m/d");
        $studentId = Auth::user()->student_id;
        return Inertia::render("Report/create",compact("now","studentId"));
    }

    public function store(reportRequest $reportRequest){
        $date = DateConvertor::shamsi2miladi( $reportRequest->date);
        $check = Report::where("date",$date )->where("student_id",$reportRequest->student_id)->first();

        if($check){
            return redirect()->route("report.create")->withErrors("شما قبلا در این تاریخ گزارش خود را ثبت کرده اید");
        }
        $report = new Report();
        $report->text = $reportRequest->text;
        $report->date = $date;
        $report->start_time = $reportRequest->start_time;
        $report->end_time = $reportRequest->end_time;

        $report->student_id = $reportRequest->student_id;

        if($reportRequest->hasFile('image')){
            $image = $reportRequest->file("image") ;
            $type = $image->getClientOriginalExtension();
            $time = time();
            $image_name = $time.".".$type;
            $image->storeAs('pics', $image_name, 'public');
            $report->image = $image_name ; 
        }
        $report->save();
        return redirect()->route('report.index')->with("message","گزارش شما با موفقیت اضافه شد");
    }

    public function show(Report $report){
        Gate::authorize("view",$report);

        $date = Jalalian::fromFormat('Y-m-d H:i:s', DateConvertor::miladi2shamsi( $report->date))->format("Y/m/d");
        $start_time = Jalalian::forge($report->start_time)->format("H:i");
        $end_time = Jalalian::forge($report->end_time)->format("H:i");
        if($report->image){
            $image_url = Storage::url("pics/".$report->image);
            $image_name = $report->image;
            return Inertia::render("Report/show",compact("report","image_url","image_name","date","start_time","end_time"));
        }else{
            return Inertia::render("Report/show",compact("report","date","start_time","end_time"));
        }
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
        // dd( $date);
        // $check = Report::where("date",$reportRequest->date)->where("student_id",$reportRequest->student_id)->first();
        // if($check){
        //     return redirect()->route("report.create")->withErrors("شما قبلا در این تاریخ گزارش خود را ثبت کرده اید");
        // }
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
