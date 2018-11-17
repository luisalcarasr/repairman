<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Machine extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'area_id',
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
    ];

    public function maintenances() 
    {
        return $this->hasMany('App\Maintenance');
    }

    public function area()
    {
        return $this->belongsTo('App\Area');
    }
}
