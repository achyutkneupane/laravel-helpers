<?php

namespace AchyutN\LaravelHelpers\Pagination;

use Illuminate\Pagination\LengthAwarePaginator;

class CustomPaginator extends LengthAwarePaginator
{
    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'data' => $this->items->toArray(),
            'total' => $this->total(),
            'perPage' => $this->perPage(),
            'page' => $this->currentPage(),

        ];
    }
}
