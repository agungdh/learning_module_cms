<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bagian extends Model
{
    protected $table = 'bagian';
    public $timestamps = false;

    protected $fillable = [
                            'id_modul',
                            'bagian',
                            'text',
                            'parent_id',
                            'posisi',
    					];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user');
    }

	public function modul()
    {
        return $this->belongsTo('App\Models\Modul', 'id_modul');
    }

    public function childs()
    {
        return $this->hasMany('App\Models\Bagian', 'parent_id')->orderBy('posisi');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Bagian', 'parent_id');
    }
}
