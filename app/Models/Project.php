<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Project extends Model
{
    protected $fillable = ['nama', 'deskripsi', 'tujuan', 'start_date', 'end_date', 'provinsi', 'kota', 'gmaps', 'jumlah_pendanaan', 'jenis_dana', 'dana_lain', 'deskripsi_pelanggan', 'company_id'];

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
        public function targetPelanggan()
    {
        return $this->hasMany(TargetPelanggan::class);
    }
}

