<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Contractor;
use App\Models\Device;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $alerts = $this->getALl($request->all());
        return $this->responseSuccess($alerts);
    }

    protected function getALl($data)
    {
        $order = $data['order'];
        $column = $data['column'];
        $query = json_decode($data['query']);
        $contractorId = +$query->contractor_id;
        $groupId = +$query->group_id;
        $deviceId = +$query->device_id;
        $getAll = $query->get_all;
        $searchMonth = $query->month;
        $startDate = $query->start_date;
        $endDate = $query->end_date;

        if (is_null($column) || !in_array($column, ['start_date', 'end_date', 'a_name', 'g_name', 'c_name'])) {
            $column = 'alerts.id';
        }

        if (!in_array($order, ["asc", "desc"])) {
            $order = "desc";
        }

        $size = +$data['size'];
        if (!is_numeric($size)) {
            $size = 10;
        }

        $alerts = Alert::query()->select(DB::raw('DATE_FORMAT(alerts.created_at, "%Y年%m月%d日 %H:%i:%s") as start_date,
            DATE_FORMAT(alerts.updated_at, "%Y年%m月%d日 %H:%i:%s") as end_date'), 'devices.name as d_name',
            'groups.name as g_name', 'contractors.name as c_name', 'alerts.name as a_name')
            ->leftJoin('devices', 'alerts.device_id', 'devices.id')
            ->leftJoin('groups', 'devices.group_id', 'groups.id')
            ->leftJoin('contractors', 'devices.contractor_id', 'contractors.id');
        if ($getAll == false) {
            if ($deviceId != 0) {
                $alerts->where('devices.id', $deviceId);
            } elseif ($groupId != 0) {
                $alerts->where('groups.id', $deviceId);
            } else if ($contractorId != 0) {
                $alerts->where('contractors.id', $contractorId);
            }
        }
        return $alerts->orderBy($column, $order)->paginate($size);
    }

    public function getDataTree()
    {
        $contractors = Contractor::select(
            'contractors.id',
            'contractors.name',
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
                    'groups' => [],
                ];
            }
            $groupParentId = $contractor['group_parent_id'];
            $groupId = $contractor['group_id'];
            if (!is_null($groupParentId)) {
                if (!isset($groupedData[$contractorId]['groups'][$groupParentId])) {
                    $group = Group::find($groupParentId);
                    $childGroups = Group::select('groups.id as group_id', 'groups.name as group_name')
                        ->where('group_id', $groupParentId)
                        ->where('contractor_id', $contractorId)
                        ->get()->toArray();
                    $devices = Device::query()->select('id', 'name')->where('group_id', $group->id)->get()->toArray();
                    $dataChildGroup = [];
                    foreach ($childGroups as $childGroup) {
                        $childGroupId = $childGroup['group_id'];
                        $devices = Device::query()->select('id', 'name')->where('group_id', $childGroupId)->get()->toArray();
                        $dataChildGroup[$childGroupId] = [
                            'group_id' => $childGroup['group_id'],
                            'group_name' => $childGroup['group_name'],
                            'devices_child_group' => $devices
                        ];
                    }
                    $groupedData[$contractorId]['groups'][$groupParentId] = [
                        'group_id' => $group->id,
                        'group_name' => $group->name,
                        'devices_group' => $devices,
                        'child_group' => $dataChildGroup,
                    ];
                }
            } else {
                if (!isset($groupedData[$contractorId]['groups'][$groupId]) && isset($contractor['group_id'])) {
                    $devices = Device::query()->select('id', 'name')->where('group_id', $contractor['group_id'])->get()->toArray();
                    $child = [
                        'group_id' => $contractor['group_id'],
                        'group_name' => $contractor['group_name'],
                        'devices_group' => $devices,
                        'child_group' => [],
                    ];
                    array_push($groupedData[$contractorId]['groups'], $child);
                }
            }
        }

        $res = new \stdClass();
        $res->id = 'all';
        $res->name = '全てのアラート';
        $res->groups = [];
        array_push($groupedData, $res);
        $result = array_reverse(array_values($groupedData));
        return $this->responseSuccess($result);
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
