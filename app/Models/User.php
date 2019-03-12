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
}
