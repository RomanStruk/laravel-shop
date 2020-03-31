<?php


namespace App\Services\Data\Filter;


use App\Filter;
use App\Services\PaginateSession;
use Illuminate\Database\Eloquent\Collection;

class GetFilters
{
    /**
     * @var PaginateSession
     */
    private $paginateSession;

    public function __construct(PaginateSession $paginateSession)
    {
        $this->paginateSession = $paginateSession;
    }


    /**
     * @param bool $paginate
     * @param array $select
     * @param null $category
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|Collection
     */
    public function handel($paginate = false, $select = ['*'], $category = null)
    {
        $filter = Filter::with('allAttributes');

        if (! $paginate)
            return $filter->get($select);

        $limit = $this->paginateSession->getLimit();
        return $filter->paginate($limit, $select);

    }
}
