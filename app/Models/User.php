<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
                            'username',
                            'password',
                            'nama',
                            'id_peran',
    					];

	protected $hidden = [
					        'password',
					    ];

    public function hakAkses()
    {
        return $this->hasMany('App\Models\HakAkses', 'id_user');
    }

    public function moduls()
    {
        return $this->hasMany('App\Models\Modul', 'id_user');
    }

    public function peran()
    {
        return $this->belongsTo('App\Models\Peran', 'id_peran');
    }
}
