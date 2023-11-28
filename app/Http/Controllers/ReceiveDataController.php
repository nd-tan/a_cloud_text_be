<?php

namespace App\Http\Controllers;

use App\Models\ReceiveData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceiveDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $request->only([
            'order',
            'column',
            'size',
            'query',
        ]);
        $result = $this->getAll($data);

        return $this->responseSuccess($result);
    }

    /**
     * Get all and sort group
     *
     * @param array $data
     * @return
     */
    public function getAll($data)
    {
        $order = $data['order'];
        $column = $data['column'];
        $query = json_decode($data['query']);
//        return $query->start_time;
        $contractorId = $query->contractor_id;
        $groupId = $query->group_id;
        $deviceId = $query->device_id;
        $startTime = $query->start_time;
        $endTime = $query->end_time;
        $checkTime = $query->check_time;
        $typeGetData = $query->type_get_data;

        if (is_null($column)) {
            $column = 'id';
        }

        if (!in_array($order, ["asc", "desc"])) {
            $order = "desc";
        }

        $size = +$data['size'];
        if (!is_numeric($size)) {
            $size = 10;
        }

        $receiveData = ReceiveData::query()->select('receive_data.*', DB::raw('DATE_FORMAT(receive_data.tm, "%Y-%m-%d %H:%i:%s") as start_date'));

        $receiveData = $receiveData->orderBy($column, $order);

        if (!is_null($contractorId)) {
            $receiveData = $receiveData->where('contractor_id', $contractorId);
        } elseif (!is_null($groupId)) {
            $receiveData = $receiveData->where('group_id', $contractorId);
        } elseif (!is_null($deviceId)) {
            $receiveData = $receiveData->where('device', $deviceId);
        } elseif (is_null($contractorId) && is_null($groupId) && is_null($deviceId)) {
            $receiveData = $receiveData->where('contractor_id', null);
        }

        return $receiveData->paginate($size);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
