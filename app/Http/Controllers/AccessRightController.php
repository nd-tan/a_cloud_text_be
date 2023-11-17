<?php

namespace App\Http\Controllers;

use App\Models\AccessRight;
use Illuminate\Http\Request;

class AccessRightController extends Controller
{
    public function responseSuccess($data, $httpStatusCode = 200)
    {
        return response()->json(
            [
                'data' => $data,
                'status' => $httpStatusCode
            ],
            $httpStatusCode
        );
    }

    public function responseError($error, $httpStatusCode = 400)
    {
        return response()->json(
            [
                'error' => $error,
                'status' => $httpStatusCode
            ],
            $httpStatusCode
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($request);
        $data = $request->only([
            'order',
            'column',
            'size',
            'contractorId'
        ]);
        $result = $this->getAll($data);

        return $this->responseSuccess($result);
    }

    /**
     * Get all and sort contractor
     *
     * @param  mixed $values
     * @return
     */
    public function getAll($data)
    {
        $order = $data['order'] ?? "";
        $column = $data['column'] ?? "";

        if(is_null($column) || ! in_array($column, ['name', 'state', 'start_date', 'end_date'])){
            $column = 'id';
        }

        if (! in_array($order, ["asc", "desc"])) {
            $order = "desc";
        }

        $size = $data['size'] ?? "";
        if (! is_numeric($size)) {
            $size = 10;
        }

        $accessRight = AccessRight::query()->select(
            'contractor_id',
            'remark',
            'name',
            'access_rights',
            'dashboard',
            'data',
            'data_export',
            'device',
            'alert',
            'alert_mail',
            'sensor',
            'account',
            'groups',
            'test'
            )->orderBy($column, $order);

            if (is_null($data['contractorId'])) {
                return [];
            } else {
                $accessRight->where('contractor_id', $data['contractorId']);
            }
    
        $data = $accessRight->paginate($size);
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'contractor_id',
            'remark',
            'name',
            'access_rights',
            'dashboard',
            'data',
            'data_export',
            'device',
            'alert',
            'alert_mail',
            'sensor',
            'account',
            'groups',
            'test'
        ]);
        $accessRight = new AccessRight();
        $accessRight->create($data);
        return $this->responseSuccess($data);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $accessRight = AccessRight::query()->where('id', $id)->first();
        if (is_null($accessRight)) {
            return $this->responseError('not_found');
        }
        return $this->responseSuccess($accessRight);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->only([
            'remark',
            'name',
            'access_rights',
            'dashboard',
            'data',
            'data_export',
            'device',
            'alert',
            'alert_mail',
            'sensor',
            'account',
            'groups',
            'test'
        ]);

        $accessRight = AccessRight::findOrFail($id);

        $accessRight->update($data);

        return $this->responseSuccess($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $accessRight = AccessRight::findOrFail($id);
        // Delete Event.
        $accessRight->delete();
        return $this->responseSuccess(true);
    }
}
