<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HakAkses extends Model
{
    protected $table = 'hak_akses';
    public $timestamps = false;

    protected $fillable = [
                            'id_user',
                            'route',
    					];
}
