<?php

namespace App\Services;

use App\DTO\Supports\CreateSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\Repositories\PaginationInterface;
use App\Repositories\SupportRepositoryInterface;
use stdClass;

class SupportService
{   
    /**
     * Undocumented function
     *
     * @param SupportRepositoryInterface $repository
     */
    public function __construct(
        protected SupportRepositoryInterface $repository
    ) {}

   /**
    * Undocumented function
    *
    * @param integer $page
    * @param integer $totalPerPage
    * @param string|null $filter
    * @return void
    */
    public function paginate(
        int $page = 1,
        int $totalPerPage = 15,
        string $filter = null
    ): PaginationInterface {
        return $this->repository->paginate(
            page: $page,
            totalPerPage: $totalPerPage,
            filter: $filter
        );
    }

    /**
     * Undocumented function
     *
     * @param string|null $filter
     * @return array
     */
    public function getAll(string $filter = null): array
    {
        return $this->repository->getAll($filter);
    }

    /**
     * Undocumented function
     *
     * @param string $id
     * @return stdClass|null
     */
    public function findOne(string $id): stdClass|null
    {
        return $this->repository->findOne($id);
    }

    /**
     * Undocumented function
     *
     * @param CreateSupportDTO $dto
     * @return stdClass
     */
    public function new(CreateSupportDTO $dto): stdClass
    {
        return $this->repository->new($dto);
    }

    /**
     * Undocumented function
     *
     * @param UpdateSupportDTO $dto
     * @return stdClass|null
     */
    public function update(UpdateSupportDTO $dto): stdClass|null
    {
        return $this->repository->update($dto);
    }

    /**
     * Undocumented function
     *
     * @param string $id
     * @return void
     */
    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }
}