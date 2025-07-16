<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NameServer extends Model
{
    use HasFactory;

    protected $fillable = ['nameserver1', 'nameserver2', 'tanggal_ns', 'status_ns'];
}
