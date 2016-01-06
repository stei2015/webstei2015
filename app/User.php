<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $primaryKey = 'nim';
    public $incrementing = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'namalengkap',
        'namapanggilan',
        'tempatlahir',
        'tanggallahir',
        'sma',
        'alamatasal',
        'kotaasal',
        'provinsiasal',
        'kodeposasal',
        'alamatstudi',
        'kodeposstudi',
        'hp',
        'telepondarurat',
        'email',
        'emailstudents',
        'line',
        'twitter',
        'facebook',
        'golongandarah',
        'riwayatpenyakit',
        'unit',
        'bio',
        'catatan',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'lastlogin',
    ];

}
