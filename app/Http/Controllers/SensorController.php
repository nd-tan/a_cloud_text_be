<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
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
            'contractorId',
        ]);
        $result = $this->getAll($data);
        return $this->responseSuccess($result);
    }

    /**
     * Get all and sort sensor
     *
     * @param  mixed $values
     * @return
     */
    public function getAll($data)
    {
        $order = $data['order'];
        $column = $data['column'];
        $contractorId = $data['contractorId'];

        if (is_null($column) || !in_array($column, ['id', 'name','maker','model_number'])) {
            $column = 'id';
        }

        if (!in_array($order, ["asc", "desc"])) {
            $order = "desc";
        }

        $size = $data['size'];
        if (!is_numeric($size)) {
            $size = 10;
        }

        $sensor = Sensor::query()->select(
            'id',
            'contractor_id',
            'name',
            'maker',
            'model_number',
            'interface',
            'calc',
            'unit',
            'remark',
            'updated_ID',
        );
        if($contractorId != 0){
            $sensor->where('contractor_id', $contractorId);
        }
        
        $sensor->orderBy($column, $order);

        $data = $sensor->paginate($size);

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'contractor_id',
            'name',
            'maker',
            'model_number',
            'interface',
            'calc',
            'unit',
            'remark',
        ]);
        $sensor = new Sensor();
        $sensor->create($data);
        return $this->responseSuccess($data);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sensor = Sensor::select('sensors.*', 'contractors.name as contractor_name')
        ->join('contractors', 'sensors.contractor_id', '=', 'contractors.id')
        ->where('sensors.id', $id)
        ->first();
        if (is_null($sensor)) {
            return $this->responseError('not_found');
        }

        if(!is_null($sensor->sensor_id)){
          $sensor['sensor_parent'] = Sensor::find($sensor->sensor_id)?->name;
        }
    return $this->responseSuccess($sensor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->only([
            'contractor_id',
            'name',
            'maker',
            'model_number',
            'interface',
            'calc',
            'unit',
            'remark',
        ]);

        $sensor = Sensor::findOrFail($id);

        $sensor->update($data);

        return $this->responseSuccess($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sensor = Sensor::findOrFail($id);
        if($sensor){
            Sensor::where('id', $sensor->id)->delete();
            return $this->responseSuccess(true);
        } else {
            return $this->responseSuccess("not found", 404);
        }
     
    }

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
}
