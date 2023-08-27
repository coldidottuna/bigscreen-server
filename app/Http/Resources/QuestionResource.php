<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\ChoiceResource;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $ressource =[
            'id'=>$this->id,
            'body' => $this->body,
            'type' => $this->type,
        ];
        if($this->type == 'A'){
            $ressource['option'] = ChoiceResource::collection($this->choices);
        }
        return $ressource;
    }
}
