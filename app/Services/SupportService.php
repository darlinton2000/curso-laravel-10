<?php

namespace App\Services;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use stdClass;

class SupportService
{   
    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $repository;

    /**
     * Undocumented function
     */
    public function __construct()
    {
        
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