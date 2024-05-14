<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type',
        'level',
        'parent_id',
        'order',
        'isOpen',
    ];

    /**
     * Get the parent survey.
     */
    public function parent()
    {
        return $this->belongsTo(Survey::class, 'parent_id');
    }

    /**
     * Get the child surveys.
     */
    public function children()
    {
        return $this->hasMany(Survey::class, 'parent_id');
    }

    /**
     * Get the responses for the survey.
     */
    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
