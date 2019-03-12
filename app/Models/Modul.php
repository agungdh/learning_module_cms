<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    protected $table = 'modul';
    public $timestamps = false;

    protected $fillable = [
                            'modul',
                            'id_user',
    					];

	public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user');
    }
}
