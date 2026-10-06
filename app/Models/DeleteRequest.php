<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeleteRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_uji_resistensi_id',
        'alasan',
        'status',
    ];

    public function dataUjiResistensi()
    {
        return $this->belongsTo(
            DataUjiResistensi::class,
            'data_uji_resistensi_id'
        );
    }
}