<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = "menu";
    protected $fillable = ['nombre','url','icono'];     //crear los campos masivos de la ddbb del modelo
    protected $guarded =['id'];                         //campos que no pueden ser guardados
    // public $timestamps =false;
                         //campo que no se van a usar
    public function getHijos($padres, $line)
    {
        $children =[];
        foreach($padres as $line1){
            if($line['id'] = $line1['menu_id']){
                $children = array_merge($children, [array_merge($line1, ['submenu' =>$this->getHijos($padres, $line1)])]);
            }
        }
        return $children;
    }
    public function getPadres($front)
    {
        if($front){
            return $this->whereHas('roles',function($query){
                $query->where('rol_id',session()->get('rol_id'))->orderBy('menu_id');
            })->where('estado',1)
              ->orderBy('manu_id')
              ->orderBy('orden')
              ->get()
              ->toArray();
        }
        else{
            return $this->orderBy('menu_id')
                        ->orderBy('orden')
                        ->get()
                        ->toArray();
        }
    }
    public static function getMenu($front = false)
    {
        $menus = new Menu();
        $padres = $menus->getPadres($front);
        $menuAll = [];
        foreach($padres as $line){
            if($line['menu_id'] != 0)
                break;
                $item = [array_merge($line, ['submenu' => $menus->getHijos($padres, $line)])];
                $menuAll = array_merge($menuAll, $item);
        }
        return $menuAll;
    }
    public function guardarOrden($menu)
    {
        $menus = json_decode($menu);
        foreach ($menus as $var => $value) {
            $this->where('id',$value->id)->update(['menu_id' => 0, 'orden' => $var +1]);
            if (!empty($value->children)) {
                foreach ($value->children as $key => $vchild) {
                    $update_id = $vchild->id;
                    $parent_id = $value->id;
                    $this->where('id', $update_id)->update(['menu_id' => $parent_id, 'orden' => $key =1]);
                    if (!empty($vchild->$children)) {
                        foreach ($vchild->$children as $key => $vchild1) {
                            $update_id = $vchild1->id;
                            $update_id = $vchild->id;
                            $this->where('id', $update_id)->update(['menu_id' => $parent_id, 'orden' => $key =1]);
                            if (!empty($vchild1->children)) {
                                foreach ($vchild->children as $key => $vchild2) {
                                    $update_id = $vchild2->id;
                                    $update_id = $vchild1->id;
                                    $this->where('id', $update_id)->update(['menu_id' => $parent_id, 'orden' => $key =1]);
                                    if (!empty($vchild2->children)) {
                                        foreach ($vchild2 as $key => $vchild3) {
                                            $update_id = $vchild3->id;
                                            $update_id = $vchild2->id;
                                            $this->where('id', $update_id)->update(['menu_id' => $parent_id, 'orden' => $key =1]);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
