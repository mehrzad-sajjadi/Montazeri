<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestRequest;
use App\Models\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;




class RequestController extends Controller
{
    public function index(){
        $loggedInUserId = auth()->id();    
        $requests = Request::whereHas('company', function ($query) use ($loggedInUserId) {
            $query->where('user_id', $loggedInUserId);
        })->get();
        $requests = $requests->map(function($record){
            $array=[];
            $array["date"]      = ["key"=>"date","data"=>$record->user_name ." ". $record->last_name  ,"type"=>"text", ] ;
            $array["skill"]      = ["key"=>"date","data"=>$record->skill  ,"type"=>"text", ] ;

            $array["email"]      = ["key"=>"date","data"=>$record->email  ,"type"=>"text", ] ;
            return $array;
        });
        $header = ["نام و نام خانوادگی","مهارت", "آدرس ایمیل"];
        
        return Inertia::render("Request/index",compact("requests","header"));
    }

    public function store(RequestRequest $requestRequest){
        $request =new Request();
        
        $request->company_id = $requestRequest->company_id;
        $request->skill = $requestRequest->skill;
        $request->user_id = $requestRequest->user_id;

        $request->save();
        return redirect()->back();
    }


}
