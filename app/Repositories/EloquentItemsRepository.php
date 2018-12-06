<?php

namespace App\Repositories;

use App\Models\Items;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Contracts\ItemsRepository;

/**
 * Class EloquentItemsRepository.
 */
class EloquentItemsRepository extends EloquentBaseRepository implements ItemsRepository
{
    /**
     * EloquentUserRepository constructor.
     *
     * @param Items $item
     */
    public function __construct(
        Items $item
    ) {
        parent::__construct($item);
    }

    /**
     * @param Items                               $item
     * @param array                              $input
     * @param \Illuminate\Http\UploadedFile|null $image
     *
     * @throws \App\Exceptions\GeneralException|\Exception|\Throwable
     *
     * @return mixed
     */
    public function save(Items $item, array $input)
    {

        DB::transaction(function () use ($item, $input) {
            if (! $item->save()) {
                throw new GeneralException(__('exceptions.backend.Items.save'));
            }           
            return true;
        });

        return true;
    }

    /**
     * @param Items $item
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function destroy(Items $item)
    {
        if (! $item->delete()) {
            throw new GeneralException(__('exceptions.backend.Items.delete'));
        }

        return true;
    }

    /**
     * @param array $ids
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function batchQuery(array $ids)
    {
        $query = $this->query()->whereIn('id', $ids);

        return $query;
    }

    /**
     * @param array $ids
     *
     * @throws \Exception|\Throwable
     *
     * @return mixed
     */
    public function batchDestroy(array $ids)
    {
        DB::transaction(function () use ($ids) {
            $query = $this->batchQuery($ids);            

            /** @var Items[] $items */
            $items = $query->get();

            foreach ($items as $item) {
                $this->destroy($item);
            }

            return true;
        });

        return true;
    }

}
