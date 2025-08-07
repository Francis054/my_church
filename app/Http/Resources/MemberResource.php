<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'middle_name' => $this->middle_name,
            'phone_number' => $this->phone_number,
            'home_town' => $this->home_town,
            'place_of_stay' => $this->place_of_stay,
            'parent_status' => $this->parent_status,
            'parent_name' => $this->parent_name,
            'parent_number' => $this->parent_number,
            'marriage_status' => $this->marriage_status,
            'spouse_name' => $this->spouse_name,
            'spouse_number' => $this->spouse_number,
            'number_of_children' => $this->number_of_children,
            'position' => $this->position,
        ];
    }
}
