<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $menu = 'master';

    public function index()
    {
        $users = User::whereHas('employee')->with('employee')->orderBy('id', 'DESC')->get();

        $data = [
            'users' => $users,
            'sub_menu' => 'user',
            'menu' => $this->menu
        ];

        return view('users.index')->with($data);
    }

    public function create()
    {
        $employees = Employee::doesntHave('user')->orderBy('id', 'DESC')->get();

        $data = [
            'employees' => $employees,
            'menu' => $this->menu,
            'sub_menu' => 'user'
        ];

        return view('users.create')->with($data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users,username'
        ]);

        DB::beginTransaction();
        try {
            User::create([
                'username' => $validated['username'],
                'password' => Hash::make($request->password),
                'roles' => $request->roles,
                'employee_id' => $request->employee_id
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

        // $employees = Employee::whereDoesntHave('user')->orderBy('id', 'DESC')->get();

        $employees = DB::select("SELECT users.id AS 'user_id', employee.id AS 'employee_id', employee.nama FROM employee LEFT JOIN users ON users.employee_id = employee.id WHERE users.employee_id IS NULL OR users.employee_id = $user->employee_id");
        $data = [
            'menu' => $this->menu,
            'sub_menu' => 'user',
            'user' => $user,
            'roles' => $roles,
            'employees' => $employees
        ];

        return view('users.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users,username'
        ]);

        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $user->username = $validated['username'];
            $user->employee_id = $request->employee_id;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            if ($request->roles) {
                $user->roles = $request->roles;
            }
            $user->save();
            DB::commit();
            return redirect('users')->with('success', 'Berhasil edit user');
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
