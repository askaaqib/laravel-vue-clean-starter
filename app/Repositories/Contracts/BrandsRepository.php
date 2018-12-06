<?php

namespace App\Repositories\Contracts;

use App\Models\Brands;

/**
 * Interface BrandsRepository.
 */
interface BrandsRepository extends BaseRepository
{

    public function save(Brands $brand, array $input);

    /**
     * @param Brands $brand
     *
     * @return mixed
     */
    public function destroy(Brands $brand);

    /**
     * @param array $ids
     *
     * @return mixed
     */
    public function batchDestroy(array $ids);
}
