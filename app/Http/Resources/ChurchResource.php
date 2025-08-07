<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChurchResource extends JsonResource
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
            "name"=> $this->name,
            "phone_number"=> $this->phone_number,
            "location"=> $this->location,
            "address"=> $this->address,
            "email" => $this->email,
            "mission_statement"=>$this->mission_statement,
            "logo"=> $this->logo

        ];
    }
}
