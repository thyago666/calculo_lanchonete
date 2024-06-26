<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustoVariavel extends Model
{
    use HasFactory;
    protected $table = 'custo_variavel';
    protected $fillable = ['id','descricao','valor'];
}
