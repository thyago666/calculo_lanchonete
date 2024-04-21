<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faturamento extends Model
{
    use HasFactory;
    protected $table = 'faturamento';
    protected $fillable = ['id','valor','markup','lucro'];
}
