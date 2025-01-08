<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Models\Intern;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{

    public function show(Company $company){
        return Inertia::render("Company/show",compact("company"));
    }


    public function create(){
        return Inertia::render("Company/create");
    }
    
    public function store(CompanyRequest $companyRequest ){
        $company = new Company();
 
        $company->user_id =  $companyRequest->user_id;


        $company->name =  $companyRequest->name;


        
        $company->address =  $companyRequest->address;

        $company->phone =  $companyRequest->phone;

        $company->save();
        return redirect()->route("company.index");

    }

    public function index(){
        $checkId = Company::where("user_id",Auth::user()->id)->first();
        if(!$checkId){
            return redirect()->route("company.create");
        }

        $company = Company::where('user_id', Auth::user()->id)->first();
        $ads = Intern::where('company_id', $company->id)->get()->map(function($record){
            $array=[];
            $array["skill"]      = ["key"=>"date","data"=>$record->skill,"type"=>"text", ] ;
            $array["number"]      = ["key"=>"date","data"=>$record->number,"type"=>"text", ] ;

            $array["button"]    = [ "type"=>"button",
                "items"=>[
                    ["data"=>route("intern.show",$record->id)     ,  "method"=>"get"      ,"value"=>"نمایش"           , "type"=>"show"        ],
                    ["data"=>route("intern.edit",$record->id)     ,  "method"=>"get"      ,"value"=>"ویرایش"           , "type"=>"edit"        ],
                    ["data"=>route("intern.delete",$record->id)     ,  "method"=>"delete"      ,"value"=>"حذف"           , "type"=>"delete"        ],
                ],
            ];
            return $array;
        });

        
        $header = ["مهارت اصلی","تعداد", "عملیات"];

        return Inertia::render("Company/internAdd",compact("ads","header"));
    }


}
