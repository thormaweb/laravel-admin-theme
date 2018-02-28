<?php

namespace iVirtual\AdminTheme\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        switch ($this->method()) {
            case 'POST':

                return [
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|max:255|unique:users,email'
                ];
            case 'PATCH':

                $passwordValidation = [];

                if ($this->has('old_password') || $this->has('new_password') || $this->has('new_password_confirmation')) {

                    $passwordValidation = [
                        'old_password' => 'required_with:new_password,new_password_confirmation|string|between:6,60|old_password:' . Auth::user()->id,
                        'new_password' => 'required_with:old_password,new_password_confirmation|string|between:6,60|confirmed',
                        'new_password_confirmation' => 'required_with:old_password,new_password|string|between:6,60|same:new_password',
                    ];
                }

                return array_merge([
                    'name' => 'sometimes|required|string|max:255',
                    'email' => 'required|email|max:255|unique:users,email,' . Auth::user()->id,
                ], $passwordValidation);
            default:

                return [];
        }
    }
}
