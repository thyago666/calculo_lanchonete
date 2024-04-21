<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ifood extends Model
{
    use HasFactory;
    protected $table = 'ifood';
    protected $fillable = ['id','descricao','valor'];
}
