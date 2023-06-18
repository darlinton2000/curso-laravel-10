<?php

namespace App\Services;

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
     * @param string $subject
     * @param string $status
     * @param string $body
     * @return stdClass
     */
    public function new(
        string $subject,
        string $status,
        string $body,
    ): stdClass
    {
        return $this->repository->new(
            $subject,
            $status,
            $body,  
        );
    }

    /**
     * Undocumented function
     *
     * @param string $id
     * @param string $subject
     * @param string $status
     * @param string $body
     * @return stdClass|null
     */
    public function update(
        string $id,
        string $subject,
        string $status,
        string $body,
    ): stdClass|null
    {
        return $this->repository->update(
            $id,
            $subject,
            $status,
            $body,  
        );
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