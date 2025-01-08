<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intern extends Model
{
    public $appends=["company_name"];

    public function company(){
        return $this->belongsTo(Company::class,"company_id");
    }

    public function getCompanyNameAttribute(){
        return $this->company->name;
    }



}
