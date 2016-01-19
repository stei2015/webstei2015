<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_AngelsAndMortals extends Model
{
	protected $table = 'event_angelsandmortals';
    protected $primaryKey = 'nim';
    public $incrementing = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'guess',         
    ];
}
