<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoomRequest extends FormRequest
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
        $uniqueName = Rule::unique('rooms', 'name');
        if($req->isMethod('PUT')) {
            $uniqueName->ignore($req->id);
        }
        return [
            'name' => ['required', $uniqueName, 'regex: /[^!@#$%^&*()-_=+{};:,<.>]$/', 'max:255'],
            'image' => ['nullable', 'mimes:png,jpg,jpeg', 'max:5120'],
            'type' => ['required'],
            'price' => ['required', 'integer', 'max:2147483647'],
            'acreage' => ['required', 'max:255'],
            'status' => ['required'],
            'room_no' => ['required', 'integer']
        ];
    }
}
