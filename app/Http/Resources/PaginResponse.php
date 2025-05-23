<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaginResponse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'success' => true,
            'message' => 'success',
            'data' => $this->resource ? $this->resource[0] : '',
            'pagingInfo' => [
                'limit' => $this->resource[1][0],
                'offset' => $this->resource[1][1],
                'totalCount' => $this->resource[1][2],
            ],
        ];
    }
}
