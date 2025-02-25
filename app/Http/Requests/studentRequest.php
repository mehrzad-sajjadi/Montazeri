<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class studentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "user_id"=>["required","integer"],
            "teacher_id"=>["required","integer"],
            "company"=>["required","string"],
            "position"=>["required","string"],
            "start_date"=>["required"],
            "address"=>["required","string"],
            "boss_name"=>["required","string"],
            "phone"=> ["required", 'regex:/^[0-9]{11}$/'],
            
            "saturday" => ["nullable", "boolean"],
            "sunday" => ["nullable", "boolean"],
            "monday" => ["nullable", "boolean"],
            "tuesday" => ["nullable", "boolean"],
            "wednesday" => ["nullable", "boolean"],
            "thursday" => ["nullable", "boolean"],
        ];
    }
}
