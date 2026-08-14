<?php

namespace App\Http\Resources;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Contact */
class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'branch' => $this->branch,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'working_hours' => $this->working_hours,
            'map_embed_url' => $this->map_embed_url,
        ];
    }
}
