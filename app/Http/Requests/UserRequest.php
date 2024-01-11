<?php

namespace App\Http\Requests;

use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
    public function rules(Request $req): array
    {
        $uniqueEmail = Rule::unique('users', 'email');
        if($req->method() == 'PUT'){
            $uniqueEmail->ignore($req->id);
        }
        return [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', $uniqueEmail, 'max:255'],
            'avatar' => ['nullable', 'mimes:png,jpg,jpeg', 'max:5120'],
            'phone' => ["nullable", "regex:/^0+[0-9]{9,10}$/"]
        ];
    }
}
