<?php

namespace App\Http\Resources;

class UserResource extends BaseResource
{
    public function toArray($request)
    {
        $resource = [
            'type'   =>  'user',
            'id'     =>  (string) $this->id,
            'attributes'   =>  [
                'name'              =>  $this->name,
                'email'             =>  $this->email,
                $this->mergeWhen($this->dates(), $this->dates()),
            ],
            'relations' =>  [
                $this->whenLoaded('avatar', function () {
                    return ['avatar'    =>  $this->avatar->id];
                }),
                $this->whenLoaded('posts', function () {
                    return ['posts'     =>  $this->posts->pluck('id')];
                }),
                $this->whenLoaded('chats', function () {
                    return ['chats'  =>  $this->chats->pluck('id')];
                }),
                $this->whenLoaded('tickets', function () {
                    return ['tickets'  =>  $this->tickets->pluck('id')];
                }),
            ],
        ];

        return $resource;
    }

    private function dates()
    {
        $dates = [];
        $dateColumns = ['created_at', 'updated_at'];
        foreach ($dateColumns as $column) {
            if ($this->{$column} !== null) {
                $dates[$column] = $this->{$column}->timestamp;
            }
        }

        return empty($dates) ? false : $dates;
    }
}
