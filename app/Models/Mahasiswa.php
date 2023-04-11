<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table='mahasiswas';
    public $timestamps= false;
    protected $primaryKey= 'Nim';

    protected $fillable = [
        'Nim',
        'Nama',
        'Kelas',
        'Jurusan',
        'No_Handphone',
        'Email',
        'Tanggal_Lahir',
    ];

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
}
