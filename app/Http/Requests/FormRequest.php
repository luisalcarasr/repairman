<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as OldFormRequest;

class FormRequest extends OldFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->method() == "POST") {
            return $this->store();
        } else if ($this->method() == "PUT") {
            return $this->update();
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function store()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function update()
    {
        return [
            //
        ];
    }
}
