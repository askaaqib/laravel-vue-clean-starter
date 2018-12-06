<?php

namespace App\Repositories;

use App\Models\Brands;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Contracts\BrandsRepository;

/**
 * Class EloquentBrandsRepository.
 */
class EloquentBrandsRepository extends EloquentBaseRepository implements BrandsRepository
{
    /**
     * EloquentUserRepository constructor.
     *
     * @param Brands $brand
     */
    public function __construct(
        Brands $brand
    ) {
        parent::__construct($brand);
    }

    /**
     * @param Brands                               $brand
     * @param array                              $input
     * @param \Illuminate\Http\UploadedFile|null $image
     *
     * @throws \App\Exceptions\GeneralException|\Exception|\Throwable
     *
     * @return mixed
     */
    public function save(Brands $brand, array $input)
    {

        DB::transaction(function () use ($brand, $input) {
            if (! $brand->save()) {
                throw new GeneralException(__('exceptions.backend.brands.save'));
            }           
            return true;
        });

        return true;
    }

    /**
     * @param Brands $brand
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function destroy(Brands $brand)
    {
        if (! $brand->delete()) {
            throw new GeneralException(__('exceptions.backend.brands.delete'));
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

            /** @var Brands[] $brands */
            $brands = $query->get();

            foreach ($brands as $brand) {
                $this->destroy($brand);
            }

            return true;
        });

        return true;
    }

}
