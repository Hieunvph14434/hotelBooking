<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
        $uniqueName = Rule::unique('categories', 'name');
        if($req->isMethod('PUT')) {
            $uniqueName->ignore($req->id);
        }
        return [
            'name' => ['required', $uniqueName, 'regex: /[^!@#$%^&*()-_=+{};:,<.>]$/', 'max:255']
        ];
    }
}
