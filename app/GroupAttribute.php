<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupAttribute extends Model
{
    protected $table = 'group_attributes';

    public function allAttributes()
    {
        return $this->hasMany('\App\Attribute');
    }
    //
}
