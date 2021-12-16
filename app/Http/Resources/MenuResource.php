<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
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
            'category_id'=>$this->category_id,
            'original_price'=>$this->price,
            'price'=>$this->getPrice($request,$this),
            'has_chooses'=>$this->has_chooses,
            'image'=>$this->imagepath,
            'name'=>$this->lang($request->lang_id)->name,
            'adds'=>$this->getAdds($request,$this),
            'chooses'=>$this->getChooses($request,$this),
        ];
    }

    function getAdds($request,$menu){
        $result=[];
        foreach($menu->adds as $key=>$add){
            $result[$key]['id']=$add->id;
            $result[$key]['price']=$add->price;
            $result[$key]['name']=$add->lang($request->lang_id)->name;
        }
        return $result;
    }

    function getChooses($request,$menu){
        $result=[];
        foreach($menu->chooses as $key=>$choose){
            $result[$key]['id']=$choose->id;
            $result[$key]['price']=$choose->price;
            $result[$key]['name']=$choose->lang($request->lang_id)->name;
        }
        return $result;
    }

    function getPrice($request,$menu){
        $offer=$menu->shop->offers()->first();
        // there are not any offer for this shop
        if(!is_object($offer))
            return $menu->price;

        // check if offer for all branches 
        if($offer->all_branches){
            // offer for all menu items
            if($offer->all_menu==1){
                return $this->applayPrice($menu,$offer);
            // offer for custom menu items
            }else if(is_object($offer->menu()->where('id',$menu_id)->first())){
                return $this->applayPrice($menu,$offer);
            }
        // offer in custom branches
        }else{ 
            $branch=$menu->shop->branches()->where('location_id',$request->location_id)->first();
            if(is_object($offer->branches()->where('branch_id',$branch->id)->first())){
                if($offer->all_menu==1){
                    return $this->applayPrice($menu,$offer);
                // offer for custom menu items
                }else if(is_object($offer->menu()->where('menu_id',$menu->id)->first())){
                    return $this->applayPrice($menu,$offer);
                }
                
                //return $this->applayPrice($menu,$offer);
            }else{
                return $menu->price;
            }
        }
        return $menu->price;
    }

    function applayPrice($menu,$offer){
        // offer is percentage
        if($offer->offer_type===0)
            return $this->applyPercentage($menu->price,$offer->discount);
        // offer id fixed   
        else
            return $this->applyfixed($menu->price,$offer->discount);
    }

    function applyPercentage($price,$percentage){
        return $price-($price*$percentage/100);
    }

    function applyfixed($price,$fixed){
        return $price-$fixed;
    }
}
