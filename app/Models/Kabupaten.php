<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;

    protected $fillable = [
        'provinsi_id',
        'nama_kabupaten',
        'latitude',
        'longitude',
    ];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function dataUjiResistensi()
    {
        return $this->hasMany(DataUjiResistensi::class);
    }
}