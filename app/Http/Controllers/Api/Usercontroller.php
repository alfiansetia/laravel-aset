<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Usercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::all();
        return $this->response('', $data, 200);
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
        // $valid = Validator::make($request->all(), [
        //     'name'      => 'required',
        //     'email'     => 'required',
        //     'role'      => 'required|in:user,admin',
        //     'password'  => 'required'
        // ]);
        // if ($valid->fails()) {
        //     return $this->response($valid->messages()[0], null, 422);
        // }
        $this->validate(
            $request,
            [
                'name'      => 'required',
                'email'     => 'required',
                'role'      => 'required|in:user,admin',
                'password'  => 'required'
            ]
        );
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => $request->role,
        ]);
        return $this->response('Succes Insert Data!', $user, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $this->response('', $user, 200);
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
