<?php

namespace App\Http\Resources;

use App\Interfaces\DelegationInterface;
use Illuminate\Http\Resources\Json\JsonResource;

class DelegationResource extends JsonResource
{
    /**
     * @var DelegationInterface
     */
    public $resource;

    public function __construct(DelegationInterface $resource)
    {
        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return [
            'start' => $this->resource->start()->format('Y-m-d H:i:s'),
            'end' => $this->resource->end()->format('Y-m-d H:i:s'),
            'country' => $this->resource->country(),
            'amount' => $this->resource->cost()->amount(),
            'currency' => $this->resource->cost()->currency(),
        ];
    }
}
