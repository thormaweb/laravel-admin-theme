<?php

namespace iVirtual\AdminTheme\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
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
                    'email' => 'required|email|max:255|unique:users,email',
                    'role_ids' => 'required|array',
                    'role_ids.*' => 'required|exists:' . config('laratrust.tables.roles') . ',id'
                ];
            case 'PATCH':

                return[
                    'name' => 'sometimes|required|string|max:255',
                    'email' => 'required|email|max:255|unique:users,email,' . $this->id,
                    'role_ids' => 'required|array',
                    'role_ids.*' => 'required|exists:' . config('laratrust.tables.roles') . ',id'
                ];
            default:

                return [];
        }
    }
}