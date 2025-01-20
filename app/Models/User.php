<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;


    public $appends=["student_id","company_id"];
    public function company()
    {
        return $this->hasOne(Company::class,'user_id');
    }

    public function getCompanyIdAttribute()
    {
        if ($this->is_company == 1 && $this->company) {
            return $this->company->id;
        }
        return null;
    }




    public function student(){
        return $this->hasMany(Student::class);
    }

    public function getStudentIdAttribute()
    {
        if ($this->level == 0) {
            $student = Student::where('user_id', $this->id)->first();
            return $student ? $student->id : null;
        }
        return null;
    }
    
    public function isTeacher()
    {
        return $this->level > 0;
    }

    public function isStudent()
    {
        return $this->level === 0 && $this->student()->exists();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        "last_name",
        "code_id",
        'email',
        'password',
        "is_company"
    ];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }








}
