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
        'nama_lengkap',      'nama_panggilan',    'tempat_lahir',     'tanggal_lahir',
        'sma',               'alamat_asal',       'kota_asal',        'provinsi_asal',
        'kode_pos_asal',     'alamat_studi',      'kode_pos_studi',   'hp',
        'telepon_darurat',   'email',             'email_students',   'line',
        'twitter',           'facebook',          'golongan_darah',   'riwayat_penyakit',
        'unit',              'bio',               'catatan',          
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'last_login',
    ];

    public $privilegeColumns = [

        'public' => [
            'nim',               'username',          'role',
            'nama_lengkap',      'nama_panggilan',
            'sma',               'kota_asal',         'provinsi_asal',
            'email',             'email_students',    'line',
            'twitter',           'facebook',          
            'unit',              'bio',
        ],

        'private' => [
            'nim',               'username',          'role',
            'nama_lengkap',      'nama_panggilan',    'tempat_lahir',     'tanggal_lahir',
            'sma',               'alamat_asal',       'kota_asal',        'provinsi_asal',
            'kode_pos_asal',     'alamat_studi',      'kode_pos_studi',   'hp',
            'telepon_darurat',   'email',             'email_students',   'line',
            'twitter',           'facebook',          'golongan_darah',   'riwayat_penyakit',
            'unit',              'bio',               'catatan',
        ],
    ];

    
    public function scopeFilter ($query, $privilege, $search = '', $by = '') {
        
        $query = $query->select($this->privilegeColumns[$privilege]);

        if(isset($search) && $search !== '' && isset($by) && $by !== '' && in_array($by, $this->privilegeColumns[$privilege])) {
            $query = $query->where($by, 'LIKE', '%'.$search.'%');
        }

        return $query;
    }

}
