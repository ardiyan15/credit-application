<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $menu = 'master';

    public function index()
    {
        $users = User::orderBy('id', 'DESC')->get();

        $data = [
            'users' => $users,
            'sub_menu' => 'user',
            'menu' => $this->menu
        ];

        return view('users.index')->with($data);
    }

    public function create()
    {
        $data = [
            'menu' => $this->menu,
            'sub_menu' => 'user'
        ];

        return view('users.create')->with($data);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            User::create([
                'username' => $request->username,
                'fullname' => $request->fullname,
                'password' => Hash::make($request->password),
                'roles' => $request->roles,
                'nip' => $request->nip
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
        $user = User::findOrFail($id);

        $data = [
            'menu' => 'users',
            'sub_menu' => '',
            'user' => $user
        ];

        return view('users.profile')->with($data);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

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
            'menu' => $this->menu,
            'sub_menu' => 'user',
            'user' => $user,
            'roles' => $roles
        ];

        return view('users.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $user->fullname = $request->fullname;
            $user->username = $request->username;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            if ($request->roles) {
                $user->roles = $request->roles;
            }
            $user->nip = $request->nip;
            $user->save();
            DB::commit();
            return redirect('users/' . $user->id)->with('success', 'Berhasil edit user');
        } catch (\Throwable $err) {
            DB::rollBack();
            throw $err;
            return back()->with('error', 'Gagal edit user');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $user->delete();

            DB::commit();
            return back()->with('success', 'Berhasil hapus user');
        } catch (\Throwable $err) {
            DB::rollBack();
            return back()->with('error', 'Gagal hapus user');
        }
    }
}
