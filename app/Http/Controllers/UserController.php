<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $user = User::create([
            'username' => $request->get('username'),
            'fullname' => $request->get('fullname'),
            'password' => Hash::make($request->get('password')),
            'role' => $request->get('role'),
            'note' => $request->get('note'),
            'group_id' => $request->get('group_id'),
        ]);
        return $this->responseSuccess($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::select('users.*', 'contractors.name as contractor_name', 'groups.name as group_name')
            ->join('groups', 'groups.id', '=', 'users.group_id')
            ->join('contractors', 'groups.contractor_id', '=', 'contractors.id')
            ->where('users.id', $id)
            ->first();
        if (is_null($user)) {
            return $this->responseError('not_found', 404);
        }

        return $this->responseSuccess($user);
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
        $user = User::findOrFail($id);
        $user->username = $request->get('username');
        $user->fullname = $request->get('fullname');
        $user->role = $request->get('role');
        $user->note = $request->get('note');
        if (!is_null($request->get('password'))) {
            $user->password = Hash::make($request->get('password'));
        }
        $user->update();
        return $this->responseSuccess($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        if(!$user){
            return $this->responseError("not found", 404);
        }
        $user->delete();
        return $this->responseSuccess(true);
    }
}
