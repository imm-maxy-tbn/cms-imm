<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    protected $fillable = [
        'name', 'order', 'level', 'parent_indicator_id', 'sdg_id', 'description'
    ];

    // Relationship with parent indicator (self-referencing)
    public function parentIndicator()
    {
        return $this->belongsTo(Indicator::class, 'parent_indicator_id');
    }

    // Relationship with child indicators (inverse of the above)
    public function childIndicators()
    {
        return $this->hasMany(Indicator::class, 'parent_indicator_id');
    }

    // Relationship with SDGs (many-to-many)
    public function sdgs()
    {
        return $this->belongsToMany(Sdg::class);
    }

    //Optional Relationship with Metrics (many-to-many)
    public function metrics()
    {
        return $this->belongsToMany(Metric::class);
    }
}
