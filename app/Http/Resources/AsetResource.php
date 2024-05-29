<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AsetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id'            => $this->id,
            'code'          => $this->code,
            'name'          => $this->name,
            'jumlah'        => $this->jumlah,
            'nilai'         => $this->nilai,
            'nilai_parse'   => $this->nilai_parse(),
            'kondisi'       => $this->kondisi,
            'status'        => $this->status,
            'tgl_terima'    => $this->tgl_terima,
            'batas'         => $this->batas,
            'image'         => $this->image,
            'batas_parse'   => $this->batas_parse(),
            'masa_parse'    => $this->masa_parse(),
            'sisa_parse'    => $this->sisa_parse(),
            'category_id'   => $this->category_id,
            'location_id'   => $this->location_id,
            'jenis_id'      => $this->jenis_id,
            'image'         => $this->image,
            'image'         => $this->image,
            'category'      => new CategoryResource($this->whenLoaded('category')),
            'location'      => new LocationResource($this->whenLoaded('location')),
            'jenis'         => new JenisResource($this->whenLoaded('jenis')),
        ];
    }
}
