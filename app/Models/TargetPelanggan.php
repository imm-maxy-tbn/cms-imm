<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetPelanggan extends Model
{
    protected $fillable = [
        'status',
        'rentang_usia',
        'deskripsi_pelanggan',
        'project_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}

