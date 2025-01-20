<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{

    public $appends=["user_name","last_name","owner_id","email"];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function getUserNameAttribute(){
        return $this->user->name;
    }

    public function getLastNameAttribute(){
        return $this->user->last_name;
    }
    public function getEmailAttribute(){
        return $this->user->email;
    }

    public function getOwnerIdAttribute(){
        return $this->company->user_id;
    }

}
