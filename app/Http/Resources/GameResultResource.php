<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'result' => $this->result,
            'state' => $this->result_state->value,
            'prize' => strval($this->getPrizeInMoney()),
            'date' => $this->created_at
        ];
    }
}
