<?php

namespace App\Http\Resources;

use App\Http\Resources\CartItemResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
        //dd($this->shop);
        return [
            'id'=>$this->id,
            'user_id'=>$this->user_id,
            'shop_id'=>$this->shop_id,
            'shop'=>$this->shop->lang($request->lang_id)->name,
            'total_price'=>$this->total_price,
            'session_id'=>$this->session_id,
            'delivery_fee'=>$this->delivery_fee,
            'delivery'=> $this->shop->delivery_price,
            'has_delivery'=> $this->shop->has_delivery,
            'has_place'=> $this->shop->has_delivery,
            'time'=>$this->shop->dlivary_rime>0? $this->shop->dlivary_rime:0,
            'session_id'=>$this->session_id,
            'items'=>CartItemResource::collection($this->items)
        ];
    }
}
