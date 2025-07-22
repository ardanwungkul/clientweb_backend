<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Pelanggan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_pelanggan',
        'alamat',
        'no_hp',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
