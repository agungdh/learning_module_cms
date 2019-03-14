<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
                            'menu',
                            'icon',
                            'route',
                            'parent_id',
                            'posisi',
    					];

    public function childs()
    {
        return $this->hasMany('App\Models\Menu', 'parent_id')->orderBy('posisi', 'desc');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Menu', 'parent_id');
    }
}
