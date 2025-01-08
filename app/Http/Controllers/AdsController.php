<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdsController extends Controller
{
    public function show(Intern $intern){
        return Inertia::render("Ads/show",compact("intern"));
    }

}
