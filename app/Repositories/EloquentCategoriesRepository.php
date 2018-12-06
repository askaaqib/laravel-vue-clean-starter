<?php

namespace App\Repositories;

use App\Models\Categories;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Contracts\CategoriesRepository;

/**
 * Class EloquentCategoriesRepository.
 */
class EloquentCategoriesRepository extends EloquentBaseRepository implements CategoriesRepository
{
    /**
     * EloquentUserRepository constructor.
     *
     * @param Categories $category
     */
    public function __construct(
        Categories $category
    ) {
        parent::__construct($category);
    }

    /**
     * @param Categories                               $category
     * @param array                              $input
     * @param \Illuminate\Http\UploadedFile|null $image
     *
     * @throws \App\Exceptions\GeneralException|\Exception|\Throwable
     *
     * @return mixed
     */
    public function save(Categories $category, array $input)
    {

        DB::transaction(function () use ($category, $input) {
            if (! $category->save()) {
                throw new GeneralException(__('exceptions.backend.Categories.save'));
            }           
            return true;
        });

        return true;
    }

    /**
     * @param Categories $category
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function destroy(Categories $category)
    {
        if (! $category->delete()) {
            throw new GeneralException(__('exceptions.backend.Categories.delete'));
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

            /** @var Categories[] $categorys */
            $categorys = $query->get();

            foreach ($categorys as $category) {
                $this->destroy($category);
            }

            return true;
        });

        return true;
    }

}
