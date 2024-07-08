<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatrixReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'metric_id',
        'evaluation',
        'analysis',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function metric()
    {
        return $this->belongsTo(Metric::class);
    }
}
