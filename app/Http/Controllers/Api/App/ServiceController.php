<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Requests\Api\Service\StoreRequest;
use App\Services\ServiceManagerService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends ApiAppController
{
    private $service;

    public function __construct(ServiceManagerService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'services' => $this->user->services()->with(['priceOption', 'fields.metaField'])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {

        $service = $this->service->create($request);

        $storeService = $request->user()
                                ->services()
                                ->where('id',$service->id)
                                ->with('fields.metaField', 'priceOption')
                                ->first();
        return response()->json([
            'success'   => true,
            'data'      => [
                'service' => $storeService
            ]
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * @param StoreRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreRequest $request, $id)
    {
        $user = $this->user->first();

        $service = $user->services()->find($id);
        $this->service->update($request, $service);
        $updateService = $user->services()
                        ->find($id)
                        ->with('priceOption')
                        ->first();

        return response()->json([
            'success' => true,
            'data' => [
                'service' => $updateService
            ]
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        $service = $request->user()->services()->find($id);

        if ($service->offers->count()) {
            $service->offers()->delete();
        }

        if ($service->fields->count()) {
            $service->fields()->delete();
        }

        $service->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
