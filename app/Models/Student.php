<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    public $appends=["user_name"];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function getUserNameAttribute(){
        return $this->user->name;
    }
    

}
