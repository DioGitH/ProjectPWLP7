<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\CssSelector\Node\FunctionNode;

class Matakuliah extends Model
{
    use HasFactory;
    protected $table = 'matakuliah';

    public function Mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class)->withPivot('nilai');
    }
}
