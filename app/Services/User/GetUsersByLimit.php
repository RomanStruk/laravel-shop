<?php


namespace App\Services\User;


use App\Repositories\Filters\UsersFilters;
use App\User;

class GetUsersByLimit
{
    /**
     * @var UsersFilters
     */
    private $usersFilters;

    /**
     * GetProductsByLimit constructor.
     * @param UsersFilters $usersFilters
     */
    public function __construct(UsersFilters $usersFilters)
    {
        $this->usersFilters = $usersFilters;
    }

    /**
     * @param $filters
     * @param array $fields
     * @param int $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function handel($filters, $fields = ['*'], $limit = 10)
    {
        return User::filter($this->usersFilters, $filters)
            ->select($fields)
            ->with('detail')
            ->paginate($limit);
    }

}
