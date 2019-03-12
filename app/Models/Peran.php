<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peran extends Model
{
    protected $table = 'peran';
    public $timestamps = false;

    protected $fillable = [
                            'peran',
    					];

	public function hakAksesPerans()
    {
        return $this->hasMany('App\Models\HakAksesPeran', 'id_peran');
    }

	public function users()
    {
        return $this->hasMany('App\Models\User', 'id_peran');
    }
}
