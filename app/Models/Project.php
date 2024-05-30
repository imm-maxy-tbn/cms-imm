<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Project extends Model
{
    protected $fillable = ['img', 'nama', 'deskripsi', 'tujuan', 'start_date', 'end_date', 'provinsi', 'kota', 'gmaps', 'jumlah_pendanaan', 'jenis_dana', 'dana_lain', 'deskripsi_pelanggan', 'company_id'];

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
    public function sdgs()
    {
        return $this->belongsToMany(SDG::class)->with('indicators');
    }

    public function metrics()
    {
        return $this->belongsToMany(Metric::class);
    }

    public function indicators()
    {
        return $this->belongsToMany(Indicator::class);
    }

    public function targetPelanggan()
    {
        return $this->hasMany(TargetPelanggan::class);
    }
    public function dana()
    {
        return $this->hasMany(Dana::class);
    }
}

