<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'shop_image' => $this->shop ? $this->shop->logopath : '',
            'shop' => $this->shop ? $this->shop->lang($request->lang_id)->name : '',
            'address_data' => $this->address_data,
            'address'=> $this->address ? $this->address->toArray() : null ,
            'price' => $this->price,
            'type' => $this->type,
            'mobile' => $this->mobile,
            'delevary_fee' => $this->delevary_fee,
            'created_at' => $this->created_at,
            'tracking_status' => $this->tracking_status,
            'statusname' => $this->statusname,
            'lat' => $this->branch?$this->branch->lat:'',
            'lng' => $this->branch?$this->branch->lng:'',
            'items'=> $this->items($this,$request)
        ];
    }
    function items($order,$request){
        $data=[];
        foreach ($order->items as $key=>$item){
            $data[$key]['menu_name']=$item->menu->lang($request->lang_id)->name;
            $data[$key]['image']=$item->menu->imagepath;
            $data[$key]['price']=$item->price;
            $data[$key]['number']=$item->number;
            if($item->choose)
            $data[$key]['choose']=$item->choose->lang($request->lang_id)->name;
            $data[$key]['adds']=$item->adds;
        }
        return $data;
    }

}
