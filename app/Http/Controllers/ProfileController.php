<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $data = [
            'menu' => 'users',
            'sub_menu' => '',
            'user' => User::findOrFail($id)
        ];

        return view('profile.index')->with($data);
    }

    public function edit($id)
    {
        $roles = [
            0 => [
                'name' => 'MKS',
                'value' => 'mks'
            ],
            1 => [
                'name' => 'MKA',
                'value' => 'mka'
            ],
            2 => [
                'name' => 'Kepala Cabang',
                'value' => 'kepala cabang'
            ],
        ];

        $data = [
            'menu' => 'users',
            'sub_menu' => '',
            'user' => User::findOrFail($id),
            'roles' => $roles
        ];

        return view('profile.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users,username,' . Auth::user()->id
        ]);
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $user->username = $validated['username'];
            $user->fullname = $request->fullname;
            if ($request->password) {
                $user->password = $request->password;
            }
            $user->save();
            DB::commit();
            return redirect('profile/' . $id)->with('success', 'Berhasil update user profile');
        } catch (\Throwable $err) {
            DB::rollBack();
            return back()->with('error', 'Gagal update user profile');
        }
    }

    public function destroy($id)
    {
        //
    }
}
