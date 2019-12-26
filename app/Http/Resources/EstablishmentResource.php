<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EstablishmentResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'name_label' => $this->name_label,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'website' => $this->website,
            'mail' => $this->mail,
            'address' => $this->address,
            'phone' => $this->phone,
            'image' => $this->image,
            'thumbnail' => $this->thumbnail,
            'active' => $this->active,
            'order' => $this->whenLoaded('order'),
            'coupon' => $this->whenLoaded('coupon'),
            'user' => $this->whenLoaded('user'),
            'product' => $this->whenLoaded('product'),
        ];
    }
}
