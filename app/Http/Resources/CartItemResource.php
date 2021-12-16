<?php

namespace App\Http\Resources;

use App\Models\MenuAddLang;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id'=>$this->id,
            'menu_id'=>$this->menu_id,
            'image'=>$this->menu->imagepath,
            "number"=>$this->number,
            'price'=>$this->price,
            'menu_name'=>$this->menu->lang($request->lang_id)->name,
            'choose_id'=>$this->choose_id,
            'choose_name'=>$this->choose?$this->choose->lang($request->lang_id)->name:'',
            'add_ids'=>$this->add_ids,
            'addes'=>$this->add_ids?$this->getAddesName($this,$request->lang_id):[],  
        ];
    }

    function getAddesName($obj,$lang_id){
        $result=[];
        foreach($this->add_ids as $add_id){
            $menu_add=MenuAddLang::where('add_id',$add_id)->where('lang_id',$lang_id)->first();
            if(is_object($menu_add))
                $result[]=$menu_add->name;
        }
        return $result;
    }
}
