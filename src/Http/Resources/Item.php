<?php

namespace Jakub\ProductFrontend\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

/**
 * Class Item
 * @package Jakub\ProductFrontend\Http\Resources
 */
class Item extends Resource
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
            'amount' => $this->amount
        ];
    }
}
