<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = "rol";
    protected $fillable = ['nombre'];     //crear los campos masivos de la ddbb del modelo
    protected $guarded =['id'];                         //campos que no pueden ser guardados
}
