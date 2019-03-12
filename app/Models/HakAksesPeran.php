<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HakAksesPeran extends Model
{
    protected $table = 'hak_akses_peran';
    public $timestamps = false;

    protected $fillable = [
                            'id_peran',
                            'route',
    					];
}
