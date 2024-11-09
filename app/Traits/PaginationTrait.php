<?php

namespace App\Traits;

use App\Enums\DesignationCodeEnums;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

trait PaginationTrait
{
    public static function getPages($query, $perPage, $sortBy, $sortDirection)
    {
        $page = $perPage == "All" ? -1 : intval($perPage);

        $query->orderBy($sortBy, $sortDirection);

        if ($perPage == "All") {
            $results = $query->get();
            return new \Illuminate\Pagination\LengthAwarePaginator($results, $results->count(), -1);
        }
        return $query->paginate($page);

    }

    public function getPaginate($items, $perPage = 15, $page = null, $options = []): LengthAwarePaginator
    {
        $perPage = $perPage == "All" ? -1 : intval($perPage);
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function getItems($items): Collection
    {
        return $items instanceof Collection ? $items : Collection::make($items);
    }
}
