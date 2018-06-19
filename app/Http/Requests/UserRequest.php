<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

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
        $user = User::withTrashed()->find($this->route('user'));

        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'name'     => 'required|string|max:255',
                    'email'    => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:6|confirmed',
                    'phone'    => 'required|regex:/(01)[0-9]{9}/|unique:users',
                    'avatar' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',

                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name'     => 'required|string|max:255',
                    'email'    => 'required|email|unique:users,email,'.$user->id,
                    'password' => 'confirmed',
                    'phone'    => 'required|regex:/(01)[0-9]{9}/|unique:users,mobile,'.$user->id,
                    'avatar' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
                ];
            }
            default:break;
        }
    }
}
