<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use App\Models\Group;
use Illuminate\Http\Request;
use Mockery\Undefined;

class GroupController extends Controller
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
     * Get all and sort group
     *
     * @param  mixed $values
     * @return
     */
    public function getAll($data)
    {
        $order = $data['order'];
        $column = $data['column'];

        if (is_null($column) || !in_array($column, ['name', 'state', 'start_date', 'end_date'])) {
            $column = 'id';
        }

        if (!in_array($order, ["asc", "desc"])) {
            $order = "desc";
        }

        $size = $data['size'];
        if (!is_numeric($size)) {
            $size = 10;
        }

        $group = Group::query()->select(
            'id',
            'name',
            'state',
            'start_date',
            'end_date',
            'address',
            'phone_number',
            'person',
            'remark'
        )
            ->orderBy($column, $order);

        $data = $group->paginate($size);

        return $data;
    }

    public function contractorAll()
    {
        $contractors = Contractor::select(
            'contractors.id',
            'contractors.name',
            'contractors.state',
            'contractors.start_date',
            'contractors.end_date',
            'contractors.address',
            'contractors.phone_number',
            'contractors.person',
            'contractors.remark',
            'groups.id as group_id',
            'groups.group_id as group_parent_id',
            'groups.name as group_name',
        )
            ->leftJoin('groups', 'contractors.id', '=', 'groups.contractor_id')
            ->orderBy("contractors.id", "asc")
            ->get();
        $groupedData = [];
        foreach ($contractors as $contractor) {
            $contractorId = $contractor['id'];

            if (!isset($groupedData[$contractorId])) {
                $groupedData[$contractorId] = [
                    'id' => $contractor['id'],
                    'name' => $contractor['name'],
                    'state' => $contractor['state'],
                    'start_date' => $contractor['start_date'],
                    'end_date' => $contractor['end_date'],
                    'address' => $contractor['address'],
                    'phone_number' => $contractor['phone_number'],
                    'person' => $contractor['person'],
                    'remark' => $contractor['remark'],
                    'groups' => [],
                ];
            }
            $groupParentId = $contractor['group_parent_id'];
            $groupId = $contractor['group_id'];
            if(!is_null($groupParentId)){
                if (!isset($groupedData[$contractorId]['groups'][$groupParentId])) {
                    $group = Group::find($groupParentId);
                    $groupedData[$contractorId]['groups'][$groupParentId] = [
                        'group_id' => $group->id,
                        'group_name' =>  $group->name,
                        'child_group' => [
                            [
                                'group_id' => $contractor['group_id'],
                                'group_name' =>  $contractor['group_name'],
                            ]
                        ],
                    ];
                }
            } else {
                if (!isset($groupedData[$contractorId]['groups'][$groupId]) && isset($contractor['group_id'])) {
                    $child = [
                        'group_id' => $contractor['group_id'],
                        'group_name' =>  $contractor['group_name'],
                        'child_group' => []
                    ];
                    array_push($groupedData[$contractorId]['groups'],$child);
                }
            }
        }

        $result = array_reverse(array_values($groupedData)) ;

        return $result;
    }

    public function contractorGroup(Request $request)
    {
        $contractorId = $request->get('contractorId');
        $contractorgroupId = $request->get('contractorgroupId');

        if ($contractorId == 'undefined') {
            return $this->responseError('Contractor ID is required', 400);
        }

        $query = Contractor::where('contractors.id', $contractorId)->select(
            'contractors.id as contractor_id',
            'contractors.name as contractor_name',
        );;

        if ($contractorgroupId != 'undefined') {
            $query->leftJoin('groups', 'contractors.id', '=', 'groups.contractor_id')
                ->where('groups.id', $contractorgroupId)
                ->select(
                    'groups.id as group_id',
                    'groups.name as group_name',
                    'contractors.id as contractor_id',
                    'contractors.name as contractor_name',
                );
        }

        $data = $query->first();

        if (!$data) {
            return $this->responseError('Data not found', 404);
        }

        return $this->responseSuccess($data);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'group_id',
            'contractor_id',
            'name',
            'path',
            'info_board',
            'latitude',
            'longitude',
            'group_week',
            'group_start_time',
            'group_end_time',
            'break_start_time1',
            'break_end_time1',
            'break_start_time2',
            'break_end_time2',
            'break_start_time3',
            'break_end_time3',
            'remark',
        ]);
        $group = new Group();
        $group->create($data);
        return $this->responseSuccess($data);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $group = Group::query()->where('id', $id)->first();
        if (is_null($group)) {
            return $this->responseError('not_found');
        }
        return $this->responseSuccess(['group' => $group]);
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

        $group = Group::findOrFail($id);

        $group->update($data);

        return $this->responseSuccess($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $group = Group::findOrFail($id);
        $group->delete();
        return $this->responseSuccess(true);
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
