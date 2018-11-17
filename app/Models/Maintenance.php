<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Maintenance extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'programmed_to', 'repeat_each', 'machine_id', 'maintenance_type_id', 'status', 'started_at'
    ];

    /**
     * The attributes that should be dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'started_at',
        'programmed_to',
    ];

    public function machine()
    {
        return $this->belongsTo('App\Machine');
    }

    public function maintenance_type()
    {
        return $this->belongsTo('App\MaintenanceType');
    }
}
