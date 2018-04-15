<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;

class MaintenanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasPermissionTo('write maintenances');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function store()
    {
        return [
            'description' => 'required',
            'repeat_each' => 'min:0|max:12',
            'programmed_to' => 'required',
            'machine_id' => 'required',
            'maintenance_type_id' => 'required',
        ];
    }

    /**
     * Get the validation rules that apply to the store request.
     *
     * @return array
     */
    public function update(){
        return [
            'description' => '',
            'repeat_each' => 'min:0|max:12',
            'programmed_to' => '',
            'machine_id' => '',
            'maintenance_type_id' => '',
            'status' => '',
            'started_at' => '',
        ];
    }
}
