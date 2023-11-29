<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_membership',
        'harga',
        'pesan_maksimum',
        'support',
        'fitur',
        'status_membership'
    ];
    protected $table='membership';
}
