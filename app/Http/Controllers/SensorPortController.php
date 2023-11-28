<?php

namespace App\Http\Controllers;

use App\Models\SensorPort;
use Illuminate\Http\Request;

class SensorPortController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $request->only([
            'sensor_id',
            'device_id',
        ]);

        $aliasNames = SensorPort::query();
        if ($data['device_id'] != 0) {
            $aliasNames = $aliasNames->where('device_id', $data['device_id']);
        }

        if (!is_null($data['sensor_id'])) {
            $aliasNames = $aliasNames->where('sensor_id', $data['sensor_id']);
        }
        $aliasNames = $aliasNames->select('id', 'alias_name as name')->get()->toArray();
        return $this->responseSuccess($aliasNames);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SensorPort $sensorPort)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SensorPort $sensorPort)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SensorPort $sensorPort)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SensorPort $sensorPort)
    {
        //
    }
}
