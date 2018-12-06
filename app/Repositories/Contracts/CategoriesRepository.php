<?php

namespace App\Repositories\Contracts;

use App\Models\Categories;

/**
 * Interface CategoriesRepository.
 */
interface CategoriesRepository extends BaseRepository
{

    public function save(Categories $category, array $input);

    /**
     * @param Categories $category
     *
     * @return mixed
     */
    public function destroy(Categories $category);

    /**
     * @param array $ids
     *
     * @return mixed
     */
    public function batchDestroy(array $ids);
}
