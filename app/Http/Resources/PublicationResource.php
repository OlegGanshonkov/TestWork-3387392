<?php

namespace App\Http\Resources;

use App\Models\Publication;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Date;

class PublicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var $this Publication */
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'created_at' => Date::parse($this->created_at)->toDateTimeString(),
            'updated_at' => Date::parse($this->updated_at)->toDateTimeString(),
        ];
    }
}
