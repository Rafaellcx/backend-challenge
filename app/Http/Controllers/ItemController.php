<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginateRequest;
use App\Services\Contracts\ItemServiceContract;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    protected ItemServiceContract $itemService;

    /**
     * @param ItemServiceContract $itemService
     */
    public function __construct(ItemServiceContract $itemService)
    {
        $this->itemService = $itemService;
    }

    public function items(PaginateRequest $request)
    {
        return $this->itemService->index($request->validated());
    }

    public function indexApiLegacy(PaginateRequest $request)
    {
        return $this->itemService->indexApiLegacy($request->validated());
    }
}
