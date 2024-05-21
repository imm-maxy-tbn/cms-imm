<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sdg extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'order', 'description'
    ];

    public function indicators()
    {
        return $this->belongsToMany(Indicator::class);
    }
}