<?php

namespace App\Transformers;

use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class Transformer
{
    /**
     * Transform a collection of objects
     *
     * @param Collection $objects
     *
     * @return array
     */
    public function transformCollection(Collection $objects)
    {
        return $objects->map([$this, 'transform']);
    }

    /**
     * Transform a paginated collection of objects
     *
     * @param Collection $objects
     *
     * @return array
     */
    public function transformPaginatedCollection(LengthAwarePaginator $objects)
    {
        return $objects->map([$this, 'transform'])
            // Merge the paginator meta information
            ->merge([
                'total' => $objects->total(),
                'per_page' => $objects->perPage(),
                'current_page' => $objects->currentPage(),
                'last_page' => $objects->lastPage(),
                'from' => $objects->firstItem(),
                'to' => $objects->lastItem(),
            ]);
    }

    /**
     * Transform a single object
     *
     * @param $object
     *
     * @return mixed
     */
    abstract public function transform($object);

    /**
     * Return either null or a formatted date
     *
     * @param null|Carbon $item
     * @param string $format
     *
     * @return null|string
     */
    protected static function dateFormatOrNull($item = null, $format)
    {
        return ($item) ? $item->format($format) : null;
    }
}
