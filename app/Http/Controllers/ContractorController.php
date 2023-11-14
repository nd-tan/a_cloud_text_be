<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use Illuminate\Http\Request;

class ContractorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $request->only([
            'order',
            'column',
            'size'
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
        $order = $data['order'];
        $column = $data['column'];

        if(is_null($column) || ! in_array($column, ['name', 'state', 'start_date', 'end_date'])){
            $column = 'id';
        }

        if (! in_array($order, ["asc", "desc"])) {
            $order = "desc";
        }

        $size = $data['size'];
        if (! is_numeric($size)) {
            $size = 10;
        }

        $contractor = Contractor::query()->select(
                    'id',
                    'name',
                    'state',
                    'start_date',
                    'end_date',
                    'address',
                    'phone_number',
                    'person',
                    'remark')
            ->orderBy($column, $order);

        $data = $contractor->paginate($size);

        return $data;

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'name',
            'postal_code',
            'address',
            'phone_number',
            'person',
            'logo',
            'start_date',
            'end_date',
            'remark',
        ]);
        $contractor = new Contractor();
        $contractor->create($data);
        return $this->responseSuccess($data);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $contractor = Contractor::query()->where('id', $id)->first();
        if (is_null($contractor)) {
            return $this->responseError('not_found');
        }
        return $this->responseSuccess(['contractor' => $contractor]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->only([
            'name',
            'postal_code',
            'address',
            'phone_number',
            'person',
            'logo',
            'start_date',
            'end_date',
            'remark',
        ]);

        $contractor = Contractor::findOrFail($id);

        $contractor->update($data);

        return $this->responseSuccess($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contractor = Contractor::findOrFail($id);

        // Delete Event.
        if($contractor->state != Contractor::DURING_THE_CONTRACT_PERIOD) {
            $contractor->delete();
            return $this->responseSuccess(true);

        }else {
            return $this->responseSuccess("Can not delete");
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
