<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComponentCategory extends Model
{
    protected $table = 'components_categories';

    protected $fillable = [
        'name'
    ];
    
    public function components()
    {
        return $this->hasMany('App\Component');
    }
}
