<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'date', 'repeat', 'machine_id',
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
        'date',
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
