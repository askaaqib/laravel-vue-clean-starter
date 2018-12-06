<?php

namespace App\Repositories\Contracts;

use App\Models\Items;

/**
 * Interface ItemsRepository.
 */
interface ItemsRepository extends BaseRepository
{

    public function save(Items $item, array $input);

    /**
     * @param Items $item
     *
     * @return mixed
     */
    public function destroy(Items $item);

    /**
     * @param array $ids
     *
     * @return mixed
     */
    public function batchDestroy(array $ids);
}
