<?php

namespace App\Http\Controllers\Api\App;

use App\Filters\UserFilter;
use App\Http\Controllers\Controller;
use App\Services\FilterBuilderService;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    /**
     * @var FilterBuilderService
     */
    private $builder;

    public function __construct(FilterBuilderService $builder)
    {
        $this->builder = $builder;
    }

    public function build(Request $request, UserFilter $filter)
    {
        $filter = $this->builder->create($request->headers->get('referer'));

        return [
            'success' => true,
            'data' => [
                'url' => $request->headers->get('referer'),
                'filter' => $filter
            ]
        ];
    }
}
