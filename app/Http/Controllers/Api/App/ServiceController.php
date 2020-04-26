<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Requests\Api\Service\StoreRequest;
use App\Services\ServiceManagerService;
use App\Http\Controllers\Controller;
use App\Models\User;
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
    public function index(Request $request)
    {

        $builder = $this->user->services();

        if ($request->has('status')) {
            $builder->where('status', $request->input('status'));
        }

        return response()->json([
            'services' => $builder->with(['priceOption', 'fields.metaField'])->get()
        ]);
    }


    public function count()
    {
        return response()->json([
            'count' => $this->user->services()->count()
        ]);
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $service = $this->service->create($request, $this->user);

        $this->user->update(['status' => User::WAITING_STATUS]);

        $storeService = $this->user
                            ->services()
                            ->where('services.id',$service->id)
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
        $user = $this->user;
        $service = $user->services()->find($id);

        if ($service) {
            $this->service->update($request, $service);

            return response()->json([
                'success' => true
            ]);
        }

        return response()->json([
            'success' => true
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
