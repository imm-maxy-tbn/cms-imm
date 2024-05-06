<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Project extends Model
{
    protected $fillable = ['nama', 'deskripsi', 'tujuan', 'start_date', 'end_date', 'jumlah_pendanaan', 'company_id'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function fundings()
    {
        return $this->hasMany(Funding::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}

