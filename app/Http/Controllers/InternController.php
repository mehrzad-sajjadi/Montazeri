<?php

namespace App\Http\Controllers;

use App\Http\Requests\InternRequest;
use App\Models\Intern;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternController extends Controller
{
    public function create(){
        $company_id = Auth::user()->company_id ;
        return Inertia::render("Intern/create",compact("company_id"));
    }


    public function store(InternRequest $internRequest){
        $intern = new Intern();
        $intern->skill = $internRequest->skill;
        $intern->text = $internRequest->text;
        $intern->number = $internRequest->number;
        $intern->company_id = $internRequest->company_id;
        $intern->save();
        return redirect()->route("company.index");
    }
    public function show(Intern $intern){
        
        return Inertia::render("Intern/show",compact("intern"));
    }
    
    public function edit(Intern $intern){
        
        return Inertia::render("Intern/edit",compact("intern"));
    }
    
    public function update(InternRequest $internRequest ,Intern $intern){
        $intern->skill = $internRequest->skill;
        $intern->text = $internRequest->text;
        $intern->number = $internRequest->number;
        $intern->company_id = $internRequest->company_id;
        $intern->save();
        return redirect()->route("company.index");
    }

    public function delete(Intern $intern){
        $intern->delete();
        return redirect()->route("company.index");
    }

    public function index(Request $request){
        $search = $request->input('search');
        
        $ads = Intern::when($search, function ($query, $search) {
            $query->where('skill', 'like', '%' . $search . '%');
        })->get()->map(function ($record) {
            $array = [];
            $array["company"] = ["key" => "date", "data" => $record->company_name, "type" => "text"];
            $array["skill"] = ["key" => "date", "data" => $record->skill, "type" => "text"];
            $array["number"] = ["key" => "date", "data" => $record->number, "type" => "text"];
            $array["button"] = [
                "type" => "button",
                "items" => [
                    [
                        "data" => route("ads.show", $record->id),
                        "method" => "get",
                        "value" => "نمایش",
                        "type" => "show",
                    ],
                ],
            ];
            return $array;
        });
        $header = ["نام شرکت","مهارت مورد نیاز","تعداد مورد نیاز", "عملیات"];

        return Inertia::render("Intern/index",compact("ads","header"));

    }

}
