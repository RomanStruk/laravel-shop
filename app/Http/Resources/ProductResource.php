<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        dd($request->order);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'keywords' => $this->keywords,
            'syllables' => $this
                ->syllableWithOutScope()
                ->countAvailableRemains($request->order)
                ->countProcessed($request->order)
                ->get()
                ->map(function ($syllable){
                    return [
                        'id' => $syllable->id,
                        'text' => $syllable->supplier->name. ' (' . $syllable->countAvailableRemains . ')',
                        'remains' => $syllable->remains,
                        'countAvailableRemains' => $syllable->countAvailableRemains,
                        'countProcessed' => $syllable->countProcessed,
                    ];

            }),
            'route_show' => route('admin.product.show', $this->id),
        ];
    }
}
