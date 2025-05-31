<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuponumum extends Model
{
    use HasFactory;

    protected $table = 'kuponumums'; // nama tabel baru di database

    protected $fillable = [
        'no_kupon',
        'wilayah',
        'jatah',
        'jenis_daging',
        'status',
    ];
}