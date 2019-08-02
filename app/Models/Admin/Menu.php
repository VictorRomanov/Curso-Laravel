<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = "menu";
    protected $fillable = ['nombre','url','icono'];     //crear los campos masivos de la ddbb del modelo
    protected $guarded =['id'];                         //campos que no pueden ser guardados
    public $timestamps =false;                          //campo que no se van a usar
}
