<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\User\EditUserResource;
use App\Http\Resources\Admin\User\ShowUserResource;
use App\Http\Resources\Admin\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('orders')->orderBy('created_at', 'desc');

        $users = $this->filter($users);
        $users = $users->paginate(config('kashf.pagination_per_page'));
        $users = UserResource::collection($users);
        $users->withPath(url()->full());
        $users = customPagination($users, 'users');

        return $users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'status' => $request->status,
        ]);

        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new ShowUserResource($user->load('addresses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return new EditUserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
            'channel' => $request->channel,
            'push_token_type' => $request->push_token_type,
            'push_token' => $request->push_token,
            'social_provider' => $request->social_id,
            'social_id' => $request->social_id,
        ]);

        return new EditUserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function filter($users)
    {

        if (request()->identifier) {
            $users->where('name', 'like', request('identifier') . "%")
                ->orWhere('phone', 'like', request('identifier') . "%");
        }

        if (request()->user_id) {
            $users->where('id', request()->user_id);
        }

        if (request()->name) {
            $users->where('name', 'like', request('name') . "%");
        }

        if (request()->phone) {
            $users->where('phone', request('phone'));
        }

        if (isset(request()->status)) {
            $users->where('status', request('status'));
        }

        if (isset(request()->type_id)) {
            $users->where('type_id', request('type_id'));
        }

        if (isset(request()->address)) {
            $users->where('address', request('address'));
        }

        if (isset(request()->age)) {
            $users->where('age', request('age'));
        }

        return $users;
    }
}
