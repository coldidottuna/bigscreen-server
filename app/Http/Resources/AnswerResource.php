<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $ressource = [
            'id' => $this->id,
            'question' => $this->question->body,
            'type' => $this->question->type,
            'answer' => $this->answer
        ];


        return $ressource ;
    }
}
