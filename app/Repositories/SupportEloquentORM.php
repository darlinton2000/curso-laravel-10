<?php

namespace App\Repositories;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Models\Support;
use App\Repositories\SupportRepositoryInterface;
use stdClass;

class SupportEloquentORM implements SupportRepositoryInterface
{
    /**
     * Undocumented function
     *
     * @param Support $model
     */
    public function __construct(
        protected Support $model
    ) {}

    /**
     * Undocumented function
     *
     * @param integer $page
     * @param integer $totalPerPage
     * @param string|null $filter
     * @return PaginationInterface
     */
    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        $result = $this->model
                    ->where(function ($query) use ($filter) {
                        if ($filter) {
                            $query->where('subject', $filter);
                            $query->orWhere('body', 'like', "%{$filter}%");
                        }
                    })
                    ->paginate($totalPerPage, ['*'], 'page', $page);
    }

    /**
     * Undocumented function
     *
     * @param string|null $filter
     * @return array
     */
    public function getAll(string $filter = null): array
    {
        return $this->model
                    ->where(function ($query) use ($filter) {
                        if ($filter) {
                            $query->where('subject', $filter);
                            $query->orWhere('body', 'like', "%{$filter}%");
                        }
                    })
                    ->get()
                    ->toArray();
    }

    /**
     * Undocumented function
     *
     * @param string $id
     * @return stdClass|null
     */
    public function findOne(string $id): stdClass|null
    {
        $support = $this->model->find($id);
        if (!$support) {
            return null;
        }

        return (object) $support->toArray();
    }

    /**
     * Undocumented function
     *
     * @param string $id
     * @return void
     */
    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }

    /**
     * Undocumented function
     *
     * @param CreateSupportDTO $dto
     * @return stdClass
     */
    public function new(CreateSupportDTO $dto): stdClass
    {
        $support = $this->model->create(
            (array) $dto
        );
        
        return (object) $support->toArray();
    }

    /**
     * Undocumented function
     *
     * @param UpdateSupportDTO $dto
     * @return stdClass|null
     */
    public function update(UpdateSupportDTO $dto): stdClass|null
    {
        if (!$support = $this->model->find($dto->id)) {
            return null;
        }

        $support->update(
            (array) $dto
        );

        return (object) $support->toArray();
    }
}