<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
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
            'user_id'=>$this->user_id,
            'from_admin'=>$this->from_admin,
            'admin_id'=>$this->admin_id,
            'message'=>$this->message,
            'is_read'=>$this->is_read,
            'user_name'=>$this->user->full_name,
            //'user_image'=>$this->user->image
        ];
    }
}
