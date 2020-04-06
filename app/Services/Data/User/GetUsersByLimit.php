<?php


namespace App\Services\Data\User;


use App\Services\PaginateSession;
use App\Services\ScopeFilters\UsersFilters;
use App\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetUsersByLimit
{
    /**
     * @var UsersFilters
     */
    private $usersFilters;
    /**
     * @var PaginateSession
     */
    private $paginateSession;

    /**
     * GetProductsByLimit constructor.
     * @param UsersFilters $usersFilters
     * @param PaginateSession $paginateSession
     */
    public function __construct(UsersFilters $usersFilters, PaginateSession $paginateSession)
    {
        $this->usersFilters = $usersFilters;
        $this->paginateSession = $paginateSession;
    }

    /**
     * @param $filters
     * @param array $fields
     * @return LengthAwarePaginator
     */
    public function handel($filters, $fields = ['*']):LengthAwarePaginator
    {
        return User::filter($this->usersFilters, $filters)
            ->select($fields)
            ->with('detail')
            ->with('roles')
            ->paginate($this->paginateSession->getLimit());
    }

}
