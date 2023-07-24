<?php

namespace App\Repositories;

use App\DTO\Supports\CreateSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\Enums\SupportStatus;
use App\Models\Support;
use App\Repositories\Contracts\PaginationInterface;
use App\Repositories\Contracts\SupportRepositoryInterface;
use Illuminate\Support\Facades\Gate;
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
                    // ->with(['replies' => function ($query) {
                    //     $query->limit(4);
                    //     $query->latest();
                    // }])
                    ->with('replies.user')
                    ->where(function ($query) use ($filter) {
                        if ($filter) {
                            $query->where('subject', $filter);
                            $query->orWhere('body', 'like', "%{$filter}%");
                        }
                    })
                    ->paginate($totalPerPage, ['*'], 'page', $page);
                    
        return new PaginationPresenter($result);
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
                    ->with('user')
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
        $support = $this->model->with('user')->find($id);
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
        $support = $this->model->findOrFail($id);

        if (Gate::denies('owner', $support->user->id)) {
            abort(403, 'Not Authorized');
        }

        $support->delete();
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

        if (Gate::denies('owner', $support->user->id)) {
            abort(403, 'Not Authorized');
        }

        $support->update(
            (array) $dto
        );

        return (object) $support->toArray();
    }

    /**
     * Undocumented function
     *
     * @param string $id
     * @param SupportStatus $status
     * @return void
     */
    public function updateStatus(string $id, SupportStatus $status): void
    {
        $this->model
            ->where('id', $id)
            ->update([
                'status' => $status->name,
            ]);
    }
}