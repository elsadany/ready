<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
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
        //dd($this->cuisines()->langs());
        return [
            'id'=>$this->user_id,
            'logo_path'=>$this->logopath,
            'delivery_time'=>$this->dlivary_rime!=null?$this->dlivary_rime:0,
            'cover_photo_path'=>$this->coverpath,
            'rate'=>$this->rate,
            'name'=>$this->name,
            'address'=>$this->getAddress($request,$this),
            'timing'=> $this->getTiming($request, $this),
            'min_order'=>$this->min_order,
            'has_delivery'=>$this->has_delivery,
            'category'=>$this->category->lang($request->lang_id)->name,
            'cuisin'=>$this->getCuisinArray($request,$this),
            'tags'=> $this->getTagsArray($request, $this),
            'reviews'=> $this->reviews,
            'reviews_count'=> $this->reviews()->count()
            //'cuisin'=>$this->cuisines->langs()->where('lang_id',$request->lang_id)->pluck('name')->toarray()
        ];
        
    }

    function getCuisinArray($request,$shop){
        $result=[];
        foreach($shop->cuisines as $row){
            $result[]=$row->cuisine->lang($request->lang_id)->name;
        }
        return $result;
    }
    function getTagsArray($request,$shop){
        $result=[];
        foreach($shop->tags as $row){
            $result[]=$row->tag->lang($request->lang_id)->name;
        }
        return $result;
    }

    function getAddress($request,$shop){
        $branch= \App\Models\Branch::where('shop_id',$shop->user_id)->where('location_id',$request->location_id)->first();
        if(is_object($branch))
                return $branch->lang($request->lang_id)->address;
        return '';
    }
    function getTiming($request,$shop){
        return \App\Models\ShopDays::where('shop_id',$shop->user_id)->get()->toArray();
    }
}
