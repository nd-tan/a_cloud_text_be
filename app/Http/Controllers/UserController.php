<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
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
            'groupId'
        ]);
        $result = $this->getAll($data);

        return $this->responseSuccess($result);
    }

    /**
     * Get all and sort group
     *
     * @param mixed $values
     * @return
     */
    public function getAll($data)
    {
        $order = $data['order'];
        $column = $data['column'];
        $contractorId = $data['contractorId'];
        $groupId = $data['groupId'];

        if (is_null($column)) {
            $column = 'users.id';
        }

        if (!in_array($order, ["asc", "desc"])) {
            $order = "desc";
        }

        $size = $data['size'];
        if (!is_numeric($size)) {
            $size = 10;
        }

        $accounts = User::query()->select(
            'users.id',
            'username',
            'fullname',
            'groups.name as gr_name',
            'groups.remark as gr_remark',
            'note'
        )->leftJoin('groups', 'users.group_id', 'groups.id')
        ->leftJoin('contractors', 'groups.contractor_id', 'contractors.id')
        ->where('contractors.id', $contractorId);

        if ($groupId != 0) {
            $accounts = $accounts->where('users.group_id', $groupId);
        }

        $accounts = $accounts->orderBy($column, $order);

        return $accounts->paginate($size);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

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
