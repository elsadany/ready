<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OffersNotifications extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'title'=>$this->lang(session('lang_id'))->title,
            'description'=>$this->lang(session('lang_id'))->description,
            'image'=> $this->shop?$this->shop->logopath:'',
            'shop_id'=> $this->shop_id
        ];
    }
}
