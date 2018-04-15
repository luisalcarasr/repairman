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
            'description' => 'required|max:255',
            'repeat_each' => 'min:0|max:12',
            'programmed_to' => 'required|date|after_or_equal:today',
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
            'description' => 'max:512',
            'repeat_each' => 'min:0|max:12',
            'programmed_to' => 'date|after_or_equal:today',
            'machine_id' => 'numeric',
            'maintenance_type_id' => 'numeric',
            'status' => 'max:255',
            'started_at' => 'date|after_or_equal:today',
        ];
    }
}
