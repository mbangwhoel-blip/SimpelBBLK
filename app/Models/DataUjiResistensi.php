<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class DataUjiResistensi extends Model {
    use HasFactory;
    protected $fillable = [
        'no','tahun','provinsi_id','kabupaten_id','alamat',
        'jenis_nyamuk','insektisida','metode','sampel_diperiksa',
        'bulan','status','mutasi','publikasi',
    ];
    public function provinsi() { return $this->belongsTo(Provinsi::class); }
    public function kabupaten() { return $this->belongsTo(Kabupaten::class); }
}