<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{

    public $appends=["user_id","user_name","last_name"];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function getUserIdAttribute(){
        return $this->student->user->id;
    }
    public function getUserNameAttribute(){
        return $this->student->user->name;
    }
    public function getLastNameAttribute(){
        return $this->student->user->last_name;
    }


}
