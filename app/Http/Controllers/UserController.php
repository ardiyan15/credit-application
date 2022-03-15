<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $menu = 'users';

    public function index()
    {
        $users = User::orderBy('id', 'DESC')->get();

        $data = [
            'users' => $users,
            'menu' => $this->menu
        ];

        return view('users.index')->with($data);
    }

    public function create()
    {
        $data = [
            'menu' => $this->menu
        ];

        return view('users.create')->with($data);
    }

    public function store(Request $request)
    {
        // dd($request->username);
        DB::beginTransaction();
        try {
            User::create([
                'username' => $request->username,
                'fullname' => $request->fullname,
                'password' => Hash::make($request->password),
                'roles' => $request->roles
            ]);
            DB::commit();
            return redirect('users')->with('success', 'Data Berhasil ditambahkan');
        } catch (\Throwable $err) {
            DB::rollBack();
            throw $err;
            return back()->with('error', 'Data Gagal ditambahkan');
        }
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
