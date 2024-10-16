<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'order' => [
                'id'                => $this->id,
                'customer_id'       => $this->customer_id,
                'order_no'          => $this->order_no,
                'order_date'        => $this->order_date,
                'status_id'         => $this->status_id,
                'shipment_address'  => $this->shipment_address,
            ],
            'customer' => [
                'id'        => $this->customer->id,
                'name'      => $this->customer->name,
                'surname'   => $this->customer->surname,
                'id_number' => $this->customer->id_number,
            ],
            'products' => $this->products->map(function($product) {
          
                return [
                    'id'            => $product->id,
                    'name'          => $product->name,
                    'description'   => $product->description,
                    'stock_status'  => $product->stock_status,
                ];
            }),
        ];
    }
}