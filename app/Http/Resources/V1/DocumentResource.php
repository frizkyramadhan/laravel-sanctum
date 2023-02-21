<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->doc_id,
            'docNo' => $this->doc_no,
            'docName' => $this->doc_name,
            'docType' => $this->doc_type,
            'revNo' => $this->rev_no,
            'docUrl' => $this->doc_url,
            'docStatus' => $this->doc_status,
            'idDept' => $this->id_dept,
            'dateUpdated' => $this->date_update,
        ];
    }
}
