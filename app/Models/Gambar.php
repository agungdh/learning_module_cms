<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    protected $table = 'gambar';
    public $timestamps = false;

    protected $fillable = [
                            'deskripsi',
    					];

}
