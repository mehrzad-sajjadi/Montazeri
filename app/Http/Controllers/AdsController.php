<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Models\Request;
use Inertia\Inertia;

class AdsController extends Controller
{
    public function show(Intern $intern){
        $hasRequested = Request::where('user_id', auth()->id())
            ->where('company_id', $intern->company_id)
            ->exists();

        return Inertia::render("Ads/show",compact("intern","hasRequested"));
    }

}
