<?php

namespace App\Http\Resources\API;

use Core\Http\Resources\BaseResourceCollection;

class ReportCollection extends BaseResourceCollection
{
    public function with($request): array
    {
        return [
            'filters' => [],
        ];
    }
}
