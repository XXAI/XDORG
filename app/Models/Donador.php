<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \DB;

class Donador extends Model
{
    protected $table = 'donadores';
    protected $fillable = ['nombre','a_paterno','a_materno','fecha_nacimiento' ,'curp','genero','codigo_postal','ciudad','estado_id','email','telefono_contacto'];

    public function scopeConEstado($query){
        return $query->select('donadores.*','entidades_federativas.nombre as estado',DB::raw('concat_ws(" ",donadores.a_paterno,donadores.a_materno,donadores.nombre) as nombre_completo'))->leftjoin('entidades_federativas','entidades_federativas.id','=','donadores.estado_id');
    }
}
  