<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Unit extends Model {
    use HasFactory;
    protected $fillable = ['nama_unit','kode_unit','alamat','telepon','email','kepala_unit'];
}