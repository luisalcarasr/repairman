<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use App\User;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasPermissionTo('write users');
    }

    /**
     * Get the validation rules that apply to the store request.
     *
     * @return array
     */
    public function store(){
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ];
    }

    /**
     * Get the validation rules that apply to the store request.
     *
     * @return array
     */
    public function update(){
        $user = User::find($this->route()->parameters['user']);
        return [
            'first_name' => 'required|max:45',
            'last_name' => 'required|max:45',
            'email' => 'required|max:45|email'.($user->email == $this->email ? '' : '|unique:users,email'),
            'password' => $this->password ? 'confirmed|min:8|max:45' : '',
        ];
    }
}
