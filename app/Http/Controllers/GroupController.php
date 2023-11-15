<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use App\Models\Group;
use Illuminate\Http\Request;

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

        $group = Group::query()->select(
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

        $data = $group->paginate($size);

        return $data;

    }

    public function contractorAll(){
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
            'groups.name as group_name',
        )
        ->leftJoin('groups', 'contractors.id', '=', 'groups.contractor_id')
        ->orderBy("contractors.id", "desc")
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
    
            if (!empty($contractor['group_id'])) {
                $groupId = $contractor['group_id'];
    
                if (!isset($groupedData[$contractorId]['groups'][$groupId])) {
                    $groupedData[$contractorId]['groups'][$groupId] = [
                        'group_id' => $contractor['group_id'],
                        'group_name' => $contractor['group_name'],
                        'subgroups' => [],
                    ];
                }
    
                if (!empty($contractor['subgroup_id'])) {
                    $subgroupId = $contractor['subgroup_id'];
    
                    if (!isset($groupedData[$contractorId]['groups'][$groupId]['subgroups'][$subgroupId])) {
                        $groupedData[$contractorId]['groups'][$groupId]['subgroups'][$subgroupId] = [
                            'subgroup_id' => $contractor['subgroup_id'],
                            'subgroup_name' => $contractor['subgroup_name'],
                        ];
                    }
                }
            }
        }
    
        $result = array_values($groupedData);
    
        return $result;
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
