<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'total' => $this->total,
            'comment' => $this->comment,
            'pay' => $this->pay,
            'status' => $this->status,
            'hash' => $this->hash,
            'coupon' => $this->whenLoaded('coupon'),
            'address' => $this->whenLoaded('address'),
            'establishment' => $this->whenLoaded('establishment'),
            'product' => $this->whenLoaded('product'),
        ];
    }
}
