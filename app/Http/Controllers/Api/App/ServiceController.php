<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Requests\Api\Service\StoreRequest;
use App\Services\ServiceManagerService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    private $service;

    public function __construct(ServiceManagerService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, $id)
    {
        $user = $request->user();

        $service = $user->services()->find($id);
        $this->service->update($request, $service);
        $updateService = $user
            ->services()
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
