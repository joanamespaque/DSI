<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $fillable = ['cod', 'matricula', 'nome', 'cargo', 'bruto', 'bonificado'];
    protected $table = 'funcionario';
    protected $primaryKey = 'cod';

    public static function indexLetra($letra)
    {
        return static::where('nome', 'LIKE', $letra . '%')->orderBy('bruto', 'asc')->get();
    }

    public static function busca($criterio, $condicao)
    {
        return static::where($condicao, 'LIKE', '%' . $criterio . '%')->orderBy('bruto', 'asc')->get();
    }    
}
