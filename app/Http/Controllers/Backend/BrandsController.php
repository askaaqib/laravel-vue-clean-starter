<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brands;
use Illuminate\Http\Request;
use App\Utils\RequestSearchQuery;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreBrandsRequest;
use App\Http\Requests\UpdateBrandsRequest;
use Illuminate\Database\Eloquent\Builder;
use App\Repositories\Contracts\BrandsRepository;

class BrandsController extends BackendController
{
    /**
     * @var JobcardRepository
     */
    protected $brand;

    public function __construct(BrandsRepository $brand)
    {
        //dd($jobcards);
        $this->brand = $brand;
    }
    
    /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     * @throws \Exception
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function search(Request $request)
    {

        /** @var Builder $query */
        $query = $this->brand->query();
        
        $requestSearchQuery = new RequestSearchQuery($request, $query, [
            'name',
            'items_count',
        ]);

        if ($request->get('exportData')) {
            return $requestSearchQuery->export([
                'name',
                'items_count',
                'brands.created_at',
                'brands.updated_at',
            ],
                [
                    __('validation.brands.name'),
                    __('validation.brands.items_count'),
                    __('labels.created_at'),
                    __('labels.updated_at'),
                ],
                'brands');
        }

        return $requestSearchQuery->result([
            'brands.id',
            'name',
            'items_count',
            'brands.created_at',
            'brands.updated_at',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandsRequest $request)
    {
        //dd($request->all());    
        $brand = $this->brand->make(
            $request->only('name','items_count')
        ); 
        
       $this->brand->save($brand, $request->input());

       return $this->redirectResponse($request, __('alerts.backend.brands.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brands  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brands $brand)
    {
       return $brand;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brands  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brands $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brands  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Brands $brand, UpdateBrandsRequest $request)
    {
        $brand->fill(
            $request->only('name','items_count')
        );
        
        $this->brand->save($brand, $request->input());
           
        return $this->redirectResponse($request, __('alerts.backend.brands.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brands  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brands $brand, Request $request)
    {
        $this->brand->destroy($brand);

        return $this->redirectResponse($request, __('alerts.backend.brands.deleted'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Http\RedirectResponse
     */
    public function batchAction(Request $request)
    {
        $action = $request->get('action');
        $ids = $request->get('ids');
        
        switch ($action) {
            case 'destroy':                
                    $this->brand->batchDestroy($ids);
                    return $this->redirectResponse($request, __('alerts.backend.brands.bulk_destroyed'));
                break;
        }

        return $this->redirectResponse($request, __('alerts.backend.actions.invalid'), 'error');
    }
}
