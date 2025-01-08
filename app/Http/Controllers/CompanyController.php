<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{

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
        return Inertia::render("Company/internAdd");
    }

}
