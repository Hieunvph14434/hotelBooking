<?php

namespace App\Http\Requests;

use Closure;
use Illuminate\Contracts\Validation\Validator;
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
        $passwordRule = ['regex:/^(?=.*[!@#$%^&*()-_=+{};:,<.>])(?=.*[0-9]).{8,20}$/', 'min:8', 'max:20', 'confirmed'];
        $confirmPasswordRule = [];
        if($req->isMethod('POST')){
            array_unshift($passwordRule, 'required');
            $confirmPasswordRule[] = 'required';
        }
        return [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', $uniqueEmail, 'max:255'],
            'avatar' => ['nullable', 'mimes:png,jpg,jpeg', 'max:5120'],
            'phone' => ["nullable", "regex:/^0+[0-9]{9,10}$/"],
            'password' => $passwordRule, 
            'password_confirmation' => $confirmPasswordRule
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            if($validator->failed()) {
                if ($this->is('api/*')) {
                    // Trả về JSON response cho request API
                    return response()->json(['error' => $validator->errors()], 422);
                }

                if($this->hasFile('avatar')){
                    session()->flash('originName', pathinfo($this->file('avatar')->hashName(), PATHINFO_FILENAME));
                    return redirect()->back()->withInput()->withErrors($validator)
                    ->with('image', fileUpload($this->file('avatar'), '', 'uploads/tmp-users'));
                }
                if($this->password){
                    session()->flash("oldPassword", $this->password);
                    return redirect()->back()->withInput()->withErrors($validator);
                }
                if($this->password_confirmation){
                    session()->flash("oldConfirmPassword", $this->password_confirmation);
                    return redirect()->back()->withInput()->withErrors($validator);
                }
            }
        });
    }
}
